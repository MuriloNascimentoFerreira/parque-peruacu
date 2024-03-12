@extends('layouts.site')

@section('header')
    @include('site.header')
@endsection

@section('content')
    <section class="default-banner active-blog-slider">
        <div class="item-slider relative" style="background: url('images/1.jpg');background-size: cover;">
            <div class="overlay" style="background: rgba(0,0,0,.3)"></div>
            <div class="container">
                <div class="row fullscreen justify-content-center align-items-center">
                    <div class="col-md-10 col-12">
                        <div class="banner-content text-center">
                            <a href="#" class="text-uppercase header-btn">Agendar visita</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="item-slider relative" style="background: url('images/2.jpg');background-size: cover;">
            <div class="overlay" style="background: rgba(0,0,0,.3)"></div>
            <div class="container">
                <div class="row fullscreen justify-content-center align-items-center">
                    <div class="col-md-10 col-12">
                        <div class="banner-content text-center">
                            <a href="#" class="text-uppercase header-btn">Agendar visita</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item-slider relative" style="background: url('images/3.jpg');background-size: cover;">
            <div class="overlay" style="background: rgba(0,0,0,.3)"></div>
            <div class="container">
                <div class="row fullscreen justify-content-center align-items-center">
                    <div class="col-md-10 col-12">
                        <div class="banner-content text-center">
                            <a href="#" class="text-uppercase header-btn">Agendar visita</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item-slider relative" style="background: url('images/4.jpg');background-size: cover;">
            <div class="overlay" style="background: rgba(0,0,0,.3)"></div>
            <div class="container">
                <div class="row fullscreen justify-content-center align-items-center">
                    <div class="col-md-10 col-12">
                        <div class="banner-content text-center">
                            <a href="#" class="text-uppercase header-btn">Agendar visita</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start about Area -->
    <section class="section-gap info-area" id="about">
        <div class="container">
            <div class="single-info row mt-10">
                <div class="col-lg-6 col-md-12 mt-120 text-center no-padding info-left">
                    <div class="info-thumb">
                        <img src="images/sobre.jpg" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 no-padding info-rigth">
                    <div class="info-content">
                        <h2 class="pb-30">Sobre</h2>
                        <p>O Parque Nacional Cavernas do Peruaçu é um local onde belas paisagens são emolduradas pela arte rupestre pré-histórica, em sítios arqueológicos milenares de importância internacional e suas cavernas de grandeza colossal.
                        <br><br>
                        A Unidade de Conservação foi criada em 1999, e possui área de 56.400 hectares, que compreende os municípios de Januária, Itacarambi e São João das Missões, na região norte de Minas Gerais.
                        <br><br>
                        O Parque foi estruturado recentemente e possui trilhas, mirantes e passarelas de proteção a sítios arqueológicos. Possui também um grupo de condutores ambientais treinados e credenciados pelo ICMBio para garantir uma experiência segura e única, num passeio de tirar o fôlego.</p>
                        <br>
                        <p>Fonte: <a style="color: black;" target="_blank" href="https://www.minasgerais.com.br/pt/atracoes/januaria/parque/cavernas-do-peruacu-3">Minas: Cavernas do Peruaçu</a></p>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End about Area -->


    <!-- Start feature Area -->
    <section class="feature-area section-gap" id="secvice">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-60 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">Conheça alguns roteiros</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 ">
                    <div class="single-feature mb-30">
                        <div class="title d-flex flex-row pb-20">
                            <h4>Gruta do Janelão</h4>
                        </div>
                        <p class="text-justify">
                            O lugar mais famoso do parque é o cartão postal da região. O passeio pela gruta e pelas belezas vistas ao longo do caminho vale a pena, especialmente se você só tiver um dia. Portanto, não hesite em seguir essa rota.
                            <br><br>
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 ">
                    <div class="single-feature mb-30">
                        <div class="title d-flex flex-row pb-20">
                            <h4>Lapa Bonita</h4>
                        </div>
                        <p class="text-justify">
                            A Lapa Bonita é uma de suas mais belas e ornamentadas grutas, com um salão avermelhado. Nela é possível contemplar uma das grutas mais ricas em formações rochosas, como estalactites, estalagmites e cortinas.
                            <br>
                            <br>
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 ">
                    <div class="single-feature mb-30">
                        <div class="title d-flex flex-row pb-20">
                            <h4>Lapa do Rezar</h4>
                        </div>
                        <p class="text-justify">
                            A Lapa do Rezar é um sítio arqueológico com pinturas e gravuras pré-históricas bem preservadas, localizada no cânion do rio Peruaçu. O acesso exige esforço físico, com mais de 500 degraus. O salão de entrada é muito grande, com 90m de largura e mais de 40m de altura.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 ">
                    <div class="single-feature mb-30">
                        <div class="title d-flex flex-row pb-20">
                            <h4>Lapa do índio</h4>
                        </div>
                        <p class="text-justify">
                            A Lapa do Índio possui painéis de pinturas rupestres que cobrem paredes inteiras e até mesmo o teto. Da Lapa do Índio também é possível apreciar o Mirante do Índio, em que se pode ver a abertura da Gruta do Janelão.
                            <br>
                            <br>
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 ">
                    <div class="single-feature mb-30">
                        <div class="title d-flex flex-row pb-20">
                            <h4>Lapa do Boquete</h4>
                        </div>
                        <p class="text-justify">
                            Um dos principais e mais estudados sítios arqueológicos do PARNA Peruaçu. Na Lapa do Boquete foram encontrados alguns sepultamentos e é possível verificar a presença de um silo pré-histórico – estrutura de armazenamento de alimentos.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 ">
                    <div class="single-feature mb-30">
                        <div class="title d-flex flex-row pb-20">
                            <h4>Lapa dos desenhos</h4>
                        </div>
                        <p class="text-justify">
                            Na Lapa dos Desenhos pode ser observada toda a riqueza das pinturas rupestres do Parque Nacional Cavernas do Peruaçu. A trilha margeia o rio Peruaçu ao longo de uma área deslumbrante de mata da região.
                            <br>
                            <br>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End feature Area -->

    <section class="gallery-area mb-5" id="gallery">
        <div class="container-fluid">
            <div class="row no-padding">
                <div class="active-gallery">
                    <div class="item single-gallery">
                        <img src="images/pinturas-rupestres-1.png" alt="">
                    </div>
                    <div class="item single-gallery">
                        <img src="images/agua.png" alt="">
                    </div>
                    <div class="item single-gallery">
                        <img src="images/lanterna.png" alt="">
                    </div>
                    <div class="item single-gallery">
                        <img src="images/caverna-sol-agua.png" alt="">
                    </div>
                    <div class="item single-gallery">
                        <img src="images/galinha.png" alt="">
                    </div>
                    <div class="item single-gallery">
                        <img src="images/espelho-agua.png" alt="">
                    </div>
                </div>
            </div>
        </div>

        <h2 class="my-3 mt-5 text-center"> Localização </h2>
        <div class="container ">
            <iframe class="align-self-center" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12952.535062675035!2d-44.22766315050272!3d-15.16868166989527!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7542b5f1fa5a6cf%3A0x7efd429e39fb19d4!2sParque%20Nacional%20Cavernas%20do%20Perua%C3%A7u!5e0!3m2!1spt-BR!2sbr!4v1630184890290!5m2!1spt-BR!2sbr" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </section>

@endsection

@section('footer')
    @include('site.footer')
@endsection
