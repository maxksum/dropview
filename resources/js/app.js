
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import axios from 'axios';
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const files = require.context('./', true, /\.vue$/i)

// files.keys().map(key => {
//     return Vue.component(_.last(key.split('/')).split('.')[0], files(key))
// })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import ExampleComponent from './components/ExampleComponent.vue';

 const app = new Vue({
  el: '#main',
  components: {
    ExampleComponent,
  },
  data: {
     albums: [],
     search: "",
     atoken: atoken,
   },
  mounted() {
    console.log(this.atoken);
  },
  created: function() {
    Echo.channel("Token")
    .listen(".refresh", (e) => {
      this.atoken = e.accessToken;
      console.log("CHANGED ACCESS TOKEN");
  });
  },
  methods: {
    newFunction: function() {
      var Spotify = require('spotify-web-api-js');
      var s = new Spotify();
      var temp = this;
      this.search = $('#searchreq').val();
      s.setAccessToken(this.atoken);
      /*s.getArtistAlbums('43ZHCT0cAZBISjO8DG9PnE', function(err, data) {
        if (err) console.error(err);
        else temp.albums = data.items;
});*/
s.searchAlbums(this.search, {limit: 50})
  .then(function(data) {
    console.log(data.albums.items);
    temp.albums = data.albums.items;
    s.getArtist(temp.albums[0].artists[0].id).then(function(data) {
      console.log(data);
    });
  }, function(err) {
    console.error(err);
  });
  },
}

});
