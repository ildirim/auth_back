@extends('layouts.front')
@section('front')
<div class="top_panel_title top_panel_style_6  title_present scheme_fire">
    <div class="top_panel_title_inner top_panel_inner_style_6  title_present_inner">
        <div class="content_wrap">
            <h1 class="page_title">Register</h1>
        </div>
    </div>
</div>
<div class="page_content_wrap page_paddings_yes">
    <div class="content_wrap">
        <div class="content">
            <article class="itemscope post_item post_item_single post_featured_default post_format_standard post-1372 page type-page status-publish hentry" itemscope itemtype="http://schema.org/Article">
                <section class="post_content" itemprop="articleBody">
                    <div data-vc-full-width="true" data-vc-full-width-init="false" data-vc-stretch-content="true" class="vc_row wpb_row vc_row-fluid vc_row-no-padding">
                        <div class="wpb_column vc_column_container vc_col-sm-12">
                            <div class="vc_column-inner">
                                <div class="wpb_wrapper">
                                    <div class="vc_row wpb_row vc_inner vc_row-fluid">
                                        <div class="wpb_column vc_column_container vc_col-sm-6 vc_hidden-xs">
                                            <div class="vc_column-inner">
                                                <div class="wpb_wrapper">
                                                    <div  class="wpb_single_image wpb_content_element vc_align_center">
                                                        <figure class="wpb_wrapper vc_figure">
                                                            <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="512" height="334" src="../wp-content/uploads/2021/07/output-onlinepngtools.png" class="vc_single_image-img attachment-full" alt="" loading="lazy" srcset="https://onetouch2go.com/wp-content/uploads/2021/07/output-onlinepngtools.png 512w, https://onetouch2go.com/wp-content/uploads/2021/07/output-onlinepngtools-300x196.png 300w" sizes="(max-width: 512px) 100vw, 512px" /></div>
                                                        </figure>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wpb_column vc_column_container vc_col-sm-6">
                                            <div class="vc_column-inner">
                                                <div class="wpb_wrapper">
                                                    <div class="vc_empty_space"   style="height: 32px"><span class="vc_empty_space_inner"></span></div>
                                                    <div class="wpb_text_column wpb_content_element " >
                                                        <div class="wpb_wrapper">
                                                            <div class="cleanlogin-container">
                                                                @if(auth()->check())
                                                                    <a href="{{ route('myProfile') }}">Go to my profile</a>
                                                                @else
                                                                    <form class="cleanlogin-form" method="post" action="{{ route('register') }}">
                                                                        @csrf
                                                                        <fieldset>
                                                                            <div class="cleanlogin-field">
                                                                                <input class="cleanlogin-field-username" type="text" name="full_name" placeholder="Full name" aria-label="Full name">
                                                                            </div>
                                                                            <div class="cleanlogin-field">
                                                                                <input class="cleanlogin-field-username" type="text" name="phone" placeholder="Phone" aria-label="Phone">
                                                                            </div>
                                                                            <div class="cleanlogin-field">
                                                                                <input class="cleanlogin-field-username" type="email" name="email" placeholder="Email" aria-label="Email">
                                                                            </div>
                                                                            <div class="cleanlogin-field">
                                                                                <input class="cleanlogin-field-username card-mask" type="text" name="card_no" placeholder="Card no" aria-label="Card no">
                                                                            </div>
                                                                            <div class="cleanlogin-field">
                                                                                <input class="cleanlogin-field-password" type="password" name="password" placeholder="Password" aria-label="Password">
                                                                            </div>
                                                                        </fieldset>
                                                                        <fieldset>
                                                                            <input class="cleanlogin-field" type="submit" value="Register" name="submit">
                                                                            <input type="hidden" name="action" value="login">
                                                                             <div class="cleanlogin-field cleanlogin-field-remember">
                                                                                <input type="checkbox" id="rememberme" name="rememberme" value="forever">
                                                                                <a href="{{ route('login') }}">Login</a>
                                                                            </div>
                                                                        </fieldset>
                                                                        <div class="cleanlogin-form-bottom">
                                                                        </div>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="vc_row-full-width"></div>
                </section>
                <!-- </section> class="post_content" itemprop="articleBody"> -->
            </article>
            <!-- </article> class="itemscope post_item post_item_single post_featured_default post_format_standard post-1372 page type-page status-publish hentry" itemscope itemtype="http://schema.org/Article"> -->  
            <section class="related_wrap related_wrap_empty"></section>
        </div>
        <!-- </div> class="content"> -->
    </div>
    <!-- </div> class="content_wrap"> -->           
</div>
    <!-- </.page_content_wrap> -->
@endsection