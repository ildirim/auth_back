<td>{{ $package->name }}</td>
<td>{{ $package->card_count }}</td>
<td>{{ $package->price }}</td>
<td>{{ $statusEnum::getStatusList()[$package->status] }}</td>

<td class="text-end">
	<a href="#"  data-id="{{ $package->id }}" class="btn btn-icon btn-bg-light btn-edit btn-sm btn-edit-package" data-toggle="modal" data-target="#modal-edit-package">
		<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
			width="24" height="24"
			viewBox="0 0 24 24"
			style=" fill:#000000;">
			<path d="M 19.171875 2 C 18.448125 2 17.724375 2.275625 17.171875 2.828125 L 16 4 L 20 8 L 21.171875 6.828125 C 22.275875 5.724125 22.275875 3.933125 21.171875 2.828125 C 20.619375 2.275625 19.895625 2 19.171875 2 z M 14.5 5.5 L 3 17 L 3 21 L 7 21 L 18.5 9.5 L 14.5 5.5 z"></path>
		</svg>
	</a>
	<a href="javascript:void(0);" data-action="{{ route('deletePackage', $package->id) }}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-icon btn-bg-light btn-delete btn-sm btn-delete-package" data-id="{{ $package->id }}">
		<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
			width="24" height="24"
			viewBox="0 0 24 24"
			style=" fill:#000000;">
			<path d="M 10 2 L 9 3 L 4 3 L 4 5 L 20 5 L 20 3 L 15 3 L 14 2 L 10 2 z M 5 7 L 5 22 L 19 22 L 19 7 L 5 7 z M 8 9 L 10 9 L 10 20 L 8 20 L 8 9 z M 14 9 L 16 9 L 16 20 L 14 20 L 14 9 z"></path>
		</svg>
	</a>
</td>
