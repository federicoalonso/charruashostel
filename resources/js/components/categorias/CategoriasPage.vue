<template>
  <main class="main-container">
    <div class="container pt-3">
      <div class="row">
        <div class="col-12 mb-4">
          <div class="card border-0">
            <categorias-form></categorias-form>
          </div>
        </div>
        <categorias-list></categorias-list>
      </div>
    </div>
    <footer class="footer mt-5">
      <strong>
        Copyright © 2020
        <a href="http://kpacite.com">Kpacite.com</a>.
      </strong>
      Derechos Reservados.
      <div class="float-right d-none d-sm-inline-block">
        <b>Versión</b> 1.0.0
      </div>
    </footer>
    <toast-alert></toast-alert>
    
    <confirmation-alert></confirmation-alert>
  </main>
</template>
<script>
export default {};
</script>