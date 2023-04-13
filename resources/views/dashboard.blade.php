@extends('layouts.appfront')

@section('content')

@if(Session::get('perfil') == 'Administrador')

@php
echo "en home";
@endphp

@endif

<!--Contadores-->
<div class="">
  <div class="row top_tiles">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon" style="width:30px;"><i class="fa-solid fa-user-group"></i></div>
        <div class="count">{{$contadorUsuariosGeneral}}</div>
        <h3>Usuarios</h3>
        <p>Número total de usuarios</p>
      </div>
    </div>
    <!--
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa-solid fa-landmark-dome"></i></div>
        <div class="count">{{$contadorMonumentosGeneral}}</div>
        <h3>Monumentos</h3>
        <p>Numero total de monumentos</p>
      </div>
    </div>-->
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa-sharp fa-solid fa-person-dress"></i></div>
        <div class="count">{{$contadorUsuariosMujer}}</div>
        <h3>Mujeres</h3>
        <p>Número total de usuarios de género femenino</p>
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa-sharp fa-solid fa-person"></i></div>
        <div class="count">{{$contadorUsuariosHombre}}</div>
        <h3>Hombres</h3>
        <p>Número total de usuarios de género masculino</p>
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa-solid fa-person-half-dress"></i></div>
        <div class="count">{{$contadorUsuariosOtro}}</div>
        <h3>Otros</h3>
        <p>Número total de usuarios de género no definido</p>
      </div>
    </div>
  </div>
  <!--Galeria de monumentos
  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Galeria</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <div class="row">

            <p>Monumentos mas visitados</p>
            <div class="col-md-55">
              <div class="thumbnail">
                <div class="image view view-first">
                  <img style="width: 100%; display: block;" src="/public/images/img.jpg" alt="image">

                </div>
                <div class="caption">
                  <p><strong>Nachi cocom</strong>
                  </p>
                  <p>Monumento</p>
                </div>
              </div>
            </div>
            <div class="col-md-55">
              <div class="thumbnail">
                <div class="image view view-first">
                  <img style="width: 100%; display: block;" src="images/media.jpg" alt="image">

                </div>
                <div class="caption">
                  <p><strong>El obelisco</strong>
                  </p>
                  <p>Monumento</p>
                </div>
              </div>
            </div>
            <div class="col-md-55">
              <div class="thumbnail">
                <div class="image view view-first">
                  <img style="width: 100%; display: block;" src="images/media.jpg" alt="image">

                </div>
                <div class="caption">
                  <p><strong>El azteca</strong>
                  </p>
                  <p>Monumento</p>
                </div>
              </div>
            </div>
            <div class="col-md-55">
              <div class="thumbnail">
                <div class="image view view-first">
                  <img style="width: 100%; display: block;" src="images/media.jpg" alt="image">

                </div>
                <div class="caption">
                  <p><strong>Fusion de las razas</strong>
                  </p>
                  <p>Monumento</p>
                </div>
              </div>
            </div>
            <div class="col-md-55">
              <div class="thumbnail">
                <div class="image view view-first">
                  <img style="width: 100%; display: block;" src="images/media.jpg" alt="image">
                </div>
                <div class="caption">
                  <p><strong>Juego de pelota</strong>
                  </p>
                  <p>Monumento</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  -->

  <div class="row">

    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Localización de los usuarios <small>geo-presentación</small></h2>

          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="dashboard-widget-content">
            <div class="col-md-4 hidden-small">
              <h2 class="line_30">{{$contadorUsuariosGeneral}} usuarios entre {{$contadorPaisesGeneral}} paises</h2>

              @php

              $cont = 0
              @endphp

              @foreach($dataTotalPaises as $paisesData)

              <table class="countries_list">
                <tbody>
                  <tr>
                    <td>{{$paisesData->nombre_pais}}</td>
                    <td class="fs15 fw700 text-right">{{($contadorUsuariosPorPaises[$cont]->PaisesPorUsuarios)}}</td>
                  </tr>
                </tbody>
              </table>
                @php
                $cont++;
                @endphp
              @endforeach
            </div>
            <div id="world-map-gdp" class="col-md-8 col-sm-12 " style="height:500px;"></div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>
@endsection