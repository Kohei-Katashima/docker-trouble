import './bootstrap'
import Vue from 'vue'
import PostLike from './components/PostLike'
import PostTagsInput from './components/PostTagsInput'

const app = new Vue({
  el: '#app',
  components: {
    PostLike,
    PostTagsInput,
  }
})