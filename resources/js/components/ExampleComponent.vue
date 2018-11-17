<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                  <input type="text" id="searchreq">
                  <input type="button" value="CLICK HERE" v-on:click="newfunction()">
                </div>
            </div>
        </div>
        <div v-for="album in albums" style="border-style: solid;">
          <img :src="album.images[1].url">
          <h1>{{ album.name }}</h1>
          <h2>{{ album.artists[0].name }}</h2>
          <h2>{{ album.release_date }}</h2>
        </div>
    </div>
</template>

<script>
    export default {
      props: ['newfunction', 'albums', 'searchrequest'],
      mounted() {
        console.log('Component mounted.')
      },
      methods: {
        checkAlbum: function(album) {
          /*if (album.name.indexOf(this.searchrequest) != -1) {
            console.log("GET IT");
            return true;
          }*/
          return true;
        },
      }
    }
</script>
