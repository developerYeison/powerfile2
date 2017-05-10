@extends('admin.template.login')
 
@section('titulo')
 Error 404
@endsection

@section('login')

<img src="../../assets/image-resources/blurred-bg/blurred-bg-7.jpg" class="login-img wow fadeIn" alt="">

<div class="center-vertical">
    <div class="center-content row">

        <div class="col-md-6 center-margin">
            <div class="server-message wow bounceInDown inverse">
                <h1>Error 404</h1>
                <h2>Page not found</h2>
                <p>The page you are looking for has been moved or no longer exists. Use the search field below to locate the page you were looking for.</p>

                <form>
                    <div class="input-group mrg25B mrg10T input-group-lg">
                        <input type="text" placeholder="Search terms here..." class="form-control">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default" tabindex="-1">
                                <i class="glyph-icon icon-search"></i>
                            </button>
                        </div>
                    </div>
                    <button class="btn btn-lg btn-success">Return to previous page</button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection