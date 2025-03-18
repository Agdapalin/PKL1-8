@extends('backend.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <h3 class="fw-bold mb-3">Dashboard Overview</h3>
        <div class="row">
            @php
                $cards = [
                    ['title' => 'Visitors', 'count' => '1,294', 'icon' => 'fas fa-users', 'color' => 'primary'],
                    ['title' => 'Subscribers', 'count' => '1,303', 'icon' => 'fas fa-user-check', 'color' => 'info'],
                    ['title' => 'Sales', 'count' => '$1,345', 'icon' => 'fas fa-chart-pie', 'color' => 'success'],
                    ['title' => 'Orders', 'count' => '576', 'icon' => 'far fa-check-circle', 'color' => 'secondary']
                ];
            @endphp

            @foreach ($cards as $card)
                <div class="col-sm-6 col-md-3 mb-3">
                    <div class="card card-stats card-{{ $card['color'] }} card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center text-light">
                                        <i class="{{ $card['icon'] }} fa-2x"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">{{ $card['title'] }}</p>
                                        <h4 class="card-title">{{ $card['count'] }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Button Redirect -->
        <div class="text-center mt-4">
            <a href="https://idn00084.tigoals198.com/football.html" class="btn btn-primary btn-lg" target="_blank">
                ⚽ BOLA BROO!!!! ⚽
            </a>
        </div>
    </div>
</div>
@endsection

<!-- Footer -->
<footer class="footer bg-light py-2 fixed-bottom border-top">
    <div class="container-fluid d-flex justify-content-between align-items-center flex-wrap">
        <nav>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="https://www.instagram.com/bllrchmn_r">Jarot</a></li>
                <li class="nav-item"><a class="nav-link" href="https://accounts.google.com">Help</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Licenses</a></li>
            </ul>
        </nav>

        <div class="text-center">
            <small>© 2025, made with ❤️ by <a href="http://www.themekita.com">Jarot</a></small>
        </div>

        <div class="text-right">
            <small>Distributed by <a target="_blank" href="https://themewagon.com/">Jarot</a></small>
        </div>
    </div>
</footer>

<!-- CSS -->
<style>
    .footer {
        font-size: 12px;
    }

    .footer .nav-link {
        padding: 0 8px;
    }
</style>