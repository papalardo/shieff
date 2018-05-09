<template>
  <div v-bind:id="nome" class="modal">
    <div class="modal-content">
      <h4 class="modal-title">{{titulo}}</h4>
      <slot></slot>
    </div>
    <div class="modal-footer">
    <slot name="botoes"></slot>
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>
</template>

<script>
    export default {
      props:['nome','titulo'],
      mounted(){ 
      }

    }
</script>
