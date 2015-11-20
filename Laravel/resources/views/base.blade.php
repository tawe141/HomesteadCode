<!DOCTYPE html>
<html>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.8/vue.min.js"></script> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    </head>
    <body>
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{ URL::to('/whatdata') }}">Data.search()</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                @if(Auth::check())
                <li><a href="{{ URL::to('/store') }}">Store</a></li>
                @endif
                <li><a href="{{ URL::to('/whatdata/') }}">whatData</a></li>
                @if(Auth::check())
                <li><a href="{{ URL::to('/auth/logout') }}">Logout</a></li>
                @else
                <li><a href="{{ URL::to('/auth/login') }}">Login</a></li>
                <li><a href="{{ URL::to('/auth/register') }}">Register</a></li>
                @endif
              </ul>
              <form method="POST" class="navbar-form navbar-right" role="search" action="{{ URL::to('/search') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                  <input type="text" class="form-control" id="searchbox" name="searchbox" placeholder="Enter whatdata.ID">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                <div class="form-group">
                    <p>Search by: </p>
                </div>
                <div class="form-group">
                    <select class="form-control" id="searchmode" name="searchmode">
                        <option value="id" selected="selected">whatdata.ID</option>
                        <option value="author">author</option>
                        <option value="name">name</option>
                        <option value="tag">tag</option>
                    </select>
                </div>
              </form>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        @if(isset($success))
            <div class="alert alert-success">
                <strong>Success!</strong>
                <p>{{ $success }}</p>
            </div>
        @endif
        @if(isset($errors) and count($errors) > 0)
        	<div class="alert alert-danger">
        		<strong>Whoops!</strong> Something has gone horribly wrong.<br><br>
                @if(gettype($errors) == "object")
        		<ul>
        			@foreach ($errors->all() as $error)
        				<li>Error: {{ $error }}</li>
        			@endforeach
        		</ul>
                @elseif(gettype($errors) == "array")
                <ul>
                    @foreach ($errors as $error)
                        <li>Error: {{ $error }}</li>
                    @endforeach
                </ul>
                @endif
        	</div>
        @endif
        @yield('content')
    </body>

    <footer>
        <script>
            $("#searchmode").click(function() {
                $("#searchbox").attr("placeholder", "Enter " + $("#searchmode").find(":selected").text())
            })
        </script>
    </footer>
