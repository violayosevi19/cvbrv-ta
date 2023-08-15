 <header>
  <nav class="navbar navbar-expand-lg fixed-top navbar-scroll shadow-0 bg-primary">
    <div class="container-fluid">
              <a class="navbar-brand text-white" style="font-size: 25px;" href="#">C V. B R V</a>
              <button class="navbar-toggler ps-0" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01"
              aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
              <span class="d-flex justify-content-start align-items-center">
                <i class="fas fa-bars"></i>
              </span>
              </button>
              <div class="d-flex" id="navbarExample01">
                  @auth
                    <ul class="navbar-nav d-flex row">
                      <li class="nav-item">
                        <a class="nav-link ps-3" href="/logout">Logout</a>
                      </li>
                    </ul>
                    @else
                    <ul class="navbar-nav d-flex row">
                      <form>
                      <li class="nav-item">
                        <a class="nav-link ps-3" href="/login">Login</a>
                      </li>
                    </form>
                  </ul>
                  @endauth
            </div>
      
    </div>
  </nav>
</header>