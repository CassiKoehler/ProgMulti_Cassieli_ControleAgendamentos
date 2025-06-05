@extends('layouts.app')

@section('content')
    <div class="bg-card rounded p-6 shadow-md max-w-2xl mx-auto mb-8">
        <h2 class="text-xl font-semibold mb-4">Seja bem vinda, {{ Auth::user()->name }}!</h2>
        <p>Use o menu à esquerda para navegar entre Clientes, Profissionais, Serviços e Agendamentos.</p>
    </div>

    <!-- Carrossel de imagens -->
    <div class="max-w-3xl mx-auto">
        <div class="swiper mySwiper rounded overflow-hidden shadow-md">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('images/promo1.jpg') }}" alt="Promoção 1" class="w-full h-64 object-cover" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/promo2.jpg') }}" alt="Promoção 2" class="w-full h-64 object-cover" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/promo3.jpg') }}" alt="Promoção 3" class="w-full h-64 object-cover" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/promo4.jpg') }}" alt="Promoção 4" class="w-full h-64 object-cover" />
                </div>
            </div>
            <!-- Navegação -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        new Swiper(".mySwiper", {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
@endsection