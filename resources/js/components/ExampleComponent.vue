<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card card-default">
          <div class="card-header">Example Component</div>
          <div class="card-body">I'm an example component.</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data(){
      return{
        pokemon:[
          {id: 1, name:'Pikachu'},
          {id: 2, name:'Squirtle'},
          {id: 3, name:'Charmander'}
        ]
      }

    },
    mounted() {
      console.log('Component mounted.')
    }
  }
</script>
