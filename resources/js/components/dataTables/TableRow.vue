<style lang="scss">
button {
  width: 36px;
}
.rowHover {
  transition: 0.3s;
}
.rowHover:hover {
  cursor: pointer;
  background: rgba(0, 195, 255, 0.151);
}
.sinGuardar {
  color: red !important;
  font-weight: 900;
}
</style>
<template>
  <tr class="rowHover" v-bind:class="[this.updating ? 'sinGuardar' : '']">
    <td>{{ categoria.id }}</td>
    <td>{{ categoria.nombre }}</td>
    <td>{{ categoria.autor }}</td>
    <!-- <td>
        <div class="btn-group">
            <a href="{{ route('public.inmueblesX', $inmueble) }}" target="blank" class="btn btn-default btn-xs" style="width:28px;"><i class="fa fa-eye"></i></a>
            <a href="{{ route('administracion.inmueble.edit', $inmueble) }}" class="btn btn-info btn-xs" style="width:28px;"><i class="fa fa-pen"></i></a>
            <form method="POST" class="conf-delete" action="{{ route('admin.inmuebles.destroy', $inmueble) }}" style="display: inline">
                {{ csrf_field() }} {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger btn-xs" style="width:28px;"><i class="fa fa-times"></i></button>
            </form>
        </div>
    </td>-->
    <td>
      <div class="btn-group">
        <button
          class="btn btn-info btn-xs"
          data-toggle="modal"
          data-target="#exampleModal"
          :dusk="'categoria-' + categoria.id"
          :data-id="categoria.id"
        >
          <i class="fa fa-pen"></i>
        </button>
        <button type="submit" class="btn btn-danger btn-xs" :dusk="'categoria-del-' + categoria.id" @click="eliminarCat">
          <i class="fa fa-times"></i>
        </button>
      </div>
    </td>
  </tr>
</template>
<script>
export default {
  props: ["categoria"],
  data() {
    return {
      updating: false,
    }
  },
  methods: {
    eliminarCat(){
      axios
        .delete("/categorias/" + this.categoria.id)
        .then((res) => {
          EventBus.$emit("categoria-deleted", this.$props.categoria.id);
        })
        .catch((err) => {
          console.log(err.response.data);
        });
    }
  },
  mounted() {
    EventBus.$on("categoria-updating", (cate) => {
      console.log(cate.id == this.$props.categoria.id);
      if(cate.id == this.$props.categoria.id){
        this.updating = cate.updated;
      }else{
        this.updating = false;
      }
    });
  },
};
</script>