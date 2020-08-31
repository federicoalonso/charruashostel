<template>
  <div class="sidebar">
    <div class="marca marca-gde">
      <!-- <span>C</span>harrúas <span>H</span>ostel -->
      <span>Charrúas</span> Hostel
    </div>
    <div class="marca marca-sm">
      <span>C</span> H
    </div>
    <div class="sidebar-menu">
      <center class="profile">
        <img src="/img/AvatarIndio.png" alt />
        <p v-text="actualUser.name"></p>
      </center>
      <li class="item">
        <router-link class="menu-btn" :to="{name: 'home'}">
          <i class="fas fa-desktop"></i>
          <span>Escritorio</span>
        </router-link>
      </li>
      <li class="item" id="productos">
        <router-link class="menu-btn" to="/productos">
          <i class="fas fa-boxes"></i>
          <span>
            Productos
            <i class="fa fa-chevron-down drop-down"></i>
          </span>
        </router-link>
        <!-- 
                    <a href="#productos" class="menu-btn">
                        <i class="fa fa-boxes"></i><span>Productos <i class="fa fa-chevron-down drop-down"></i></span>
        </a> -->
        <div class="sub-menu">
          <a href="#">
            <i class="fa fa-list-ul"></i>
            <span>Resumen</span>
          </a>
          <router-link :to="{name: 'productos.configuracion'}" id="productos-categoria">
            <i class="fas fa-cogs"></i>
            <span>Configuración</span>
          </router-link>
        </div>
      </li>
      <li class="separator"></li>
      <li class="item">
          <a href="#" class="menu-btn salirAlerta">
          <i class="nav-icon fas fa-power-off"></i>
          <span>Cerrar Sesión</span>
        </a>
        <!-- <a href="{{ route('logout') }}" class="menu-btn salirAlerta">
          <i class="nav-icon fas fa-power-off"></i>
          <span>Cerrar Sesión</span>
        </a> -->
        <!-- <form
          id="logout-form"
          action="{{ route('logout') }}"
          method="POST"
          style="display: none;"
        >@csrf</form> -->
      </li>
    </div>
  </div>
</template>

<script>
export default {
};
</script>