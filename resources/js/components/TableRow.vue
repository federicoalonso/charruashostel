<style lang="scss">
    button {
        width:36px;
    }
    .rowHover {
        transition: 0.3s;
    }
    .rowHover:hover {
        cursor: pointer;
        background: rgba(0, 195, 255, 0.151);
    }
</style>
<template>
  <tr class="rowHover">
    <td>{{ categoria.id }}</td>
    <td>{{ categoria.nombre }}</td>
    <td>{{ categoria.user_id }}</td>
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
        <button class="btn btn-info btn-xs">
          <i class="fa fa-pen"></i>
        </button>
        <button type="submit" class="btn btn-danger btn-xs">
          <i class="fa fa-times"></i>
        </button>
      </div>
    </td>
  </tr>
</template>
<script>
export default {
  props: ["categoria"],
};
</script>