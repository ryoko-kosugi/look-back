

    <header class="mb-0">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark"> 
            <!--<a class="navbar-brand" href="/">Look-back</a>-->
            <a class="navbar-brand mb-0 h1" href="/">Look-back</a>
             
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="nav-bar">
                <ul class="navbar-nav mr-auto"></ul>
                <ul class="navbar-nav">
                    @if (Auth::check())
                        <li class="nav-item">{!! link_to_route('logout.get', 'Logout', [], ['class' => 'nav-link']) !!}</li>                  
                    @else 
                        <li class="nav-item">{!! link_to_route('signup.get', 'Signup', [], ['class' => 'nav-link']) !!}</li>
                        <li class="nav-item">{!! link_to_route('login', 'Login', [], ['class' => 'nav-link']) !!}</li>
                    @endif            
                </ul>                
            </div>
        </nav>
    </header>

            
    @if (Auth::check())
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
      <!-- Navbar content -->
    </nav>
    
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="ナビゲーションの切替">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
              <!--<a class="nav-link" href="#">On the day</a>-->
              {!! link_to_route('reports.create', 'On the day', [], ['class' => 'nav-link']) !!}
            </li>
            <li class="nav-item">
              <!--<a class="nav-link" href="#">One-week</a>-->
              {!! link_to_route('reports.index', 'One-week', [],['class' => 'nav-link']) !!}
            </li>
            <li class="nav-item">
              <!--<a class="nav-link" href="#">All-week</a>-->
              {!! link_to_route('reports.every_week', 'Every-week', [], ['class' => 'nav-link']) !!}
            </li>
          </ul> 
          <ul class="navbar-nav mr-auto">
            
          </ul>
        </div>
    </nav>
    @endif
    