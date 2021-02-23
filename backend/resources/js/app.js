import './bootstrap'
import Vue from 'vue'
import PostLike from './components/PostLike'

const app = new Vue({
  el: '#app',
  components: {
    PostLike,
  }
})