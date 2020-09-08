<template>
  <li class="item">
    <a href="#" class="menu-btn" @click.prevent="logout()">
      <i class="nav-icon fas fa-power-off"></i>
      <span>Cerrar Sesión</span>
    </a>
  </li>
</template>

<script>
export default {
  name: "Logout",
  methods: {
    logout() {
      axios
        .post("/logout")
        .then((data) => {
          window.location.href = "/login";
        })
        .catch((err) => {
          window.location.href = "/login";
        });
    },
  },
};
</script>