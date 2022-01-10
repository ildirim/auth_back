var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http, {
    cors: {
        origin: '*',
    }
});
var bodyParser = require('body-parser');

app.set('port', (process.env.PORT || 3001));

app.use(bodyParser.urlencoded({extended: true}));
app.use(bodyParser.json());


var pjson = require('./package.json');

var pushService = (function() {
    var connections = {};
    var connectionCustomers = {};
    return {
        
        registerUser: function(userId, connectionId) {
            if (connections[userId] === undefined) {
                connections[userId] = {};
            }
            connections[userId][connectionId] = null;
            console.log('Registered user ' + connectionId.substring(0, 4) + '*** for user ' + userId);
        },

        registerSocket: function(userId, connectionId, socket) {
            if (connections[userId] !== null && connections[userId][connectionId] === null) {
                socket.userId = userId;
                socket.connectionId = connectionId;
                connections[userId][connectionId] = socket;
                console.log('Registered socket for connection ' + connectionId.substring(0, 4) + '*** and ussssser ' + userId);
                return true;
            } else {
                console.log('Not found empty conn for connection ' + connectionId.substring(0, 4) + '*** and user ' + userId);
                return false;
            }
        },

        removeConnection: function(socket) {
            var userId = socket.userId;
            var connectionId = socket.connectionId;
            if (userId && connectionId && connections[userId] && connections[userId][connectionId]) {
                console.log('Removed socket for user ' + userId + ' and connection: ' + connectionId.substring(0, 4) + '***');
                delete connections[socket.connectionId];
            }
        },
        /**
         * Send notification to user.
         * @param userId id of user.
         * @param message message.
         */
        pushNotification: function(userId, notification) {
            var userConnections = connections[userId];
            if (userConnections) {
                for (var connectionId in userConnections) {
                    if (userConnections.hasOwnProperty(connectionId)) {
                        var socket = userConnections[connectionId];
                        if (socket !== null) {
                            socket.emit('notification', notification);
                        }
                    }
                }
            }
        },

        newWorkPermit: function(userId, senderId) {
            var userConnections = connections[userId];
            if (userConnections) {
                for (var connectionId in userConnections) {
                    if (userConnections.hasOwnProperty(connectionId)) {
                        var socket = userConnections[connectionId];
                        if (socket !== null) {
                            socket.emit('new-notification', senderId);
                        }
                    }
                }
            }
        },

        notificationFromUser: function(customerId, survey) {
            var customerConnections = connectionCustomers[customerId];
            if (customerConnections) {
                for (var connectionId in customerConnections) {
                    if (customerConnections.hasOwnProperty(connectionId)) {
                        var socket = customerConnections[connectionId];
                        if (socket !== null) {
                            socket.emit('notificationCustomer', survey);
                        }
                    }
                }
            }
        }
    }
}());

/**
* Handle connection to socket.io.
*/
    /**
     * On registered socket from client.
     */
io.on('connection', function(socket) {
    socket.on('registerUser', function(userId, connectionId) {
        pushService.registerUser(userId, connectionId);
        pushService.registerSocket(userId, connectionId, socket);
    });

    socket.on('notificationFromUser', function(complexId, notification) {
        let name = 'notification-' + complexId;
        io.emit(name, notification);

        notification.id = socket.id;
        io.emit('notificationUserOtherDevice', notification)
    });

    socket.on('surveyFromUser', function(complexId, survey) {
        let name = 'survey-' + complexId;
        io.emit(name, survey);

        survey.id = socket.id;
        io.emit('surveyUserOtherDevice', survey)
    });

    /**
     * On disconnected socket.
     */
    socket.on('disconnect', function() {
        pushService.removeConnection(socket);
    });
});

/**
* Api to register user.
*/
app.post('/api/:userId/register', function(req, res) {
    var userId = req.params['userId'];
    var connectionId = req.query['connectionId'];
    if (userId ) {
        pushService.registerUser(userId, connectionId);
        res.status(200).send('Success');
    } else {
        res.status(400).send('Bad Request');
    }
});

/**
* Api to send message to user.
*/
app.post('/api/sendNotification', function(req, res) {
    var users = req.body.users;
    var connectionUsers = pushService.getUsers();
    for(var user in users) {
        if(connectionUsers[users[user].user_id]) {
            pushService.pushNotification(users[user].user_id, users[user]);
        }
    }
    res.send('success');
});

app.post('/api/new-work-permit/:userId/:senderId', function(req, res) {
    pushService.newWorkPermit(req.params['userId'], req.params['senderId']);
    res.send('success');
});

app.post('/api/users', function(req, res) {
    
    res.send('success');
});

http.listen(app.get('port'), function() {
    console.log('Node app is running on port', app.get('port'));
});