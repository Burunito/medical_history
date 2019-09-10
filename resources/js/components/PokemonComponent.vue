<template>
	<div class="row"> 
		<spinner v-show="loading"></spinner>
	  <div class="col-sm" v-for="pokemon in pokemons">
		  <div class="card text-center" style="width: 18rem; margin-top: 70px;">
		  	<img style="height: 100px; width: 100px; background-color: #EFEFEF; margin: 20px;" class="card-img-top rounded-circle mx-auto d-block" src="/images/PokemonImg" v-bind:src="pokemon.picture" alt="">
		    <div class="card-body">
		    	<h5 class="card-title">{{pokemon.name}}</h5>
		    	<p class="card-text">{{pokemon.description}}</p>
		    	<a href="/pokemon/" class="btn btn-primary">Ver mas</a> 
		    </div>	
		  </div>
	  </div>
		
	</div>	
</template>

<style type="text/css">
	
</style>

<script type="text/javascript">
	import EventBus from '../event-bus';
	export default{
		data(){
      return{
        pokemons:[],
        loading: true
      }
    },
    created(){
      EventBus.$on('pokemon-added', data => {
      	this.pokemons.push(data);
      })
    },
		mounted(){
      axios
      .get('http://127.0.0.1:8000/pokemon')
      .then((response)=>{
      	this.pokemons=response.data,
      	this.loading=false
      })
		}
	}
</script>