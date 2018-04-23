<template>

  <span v-html="myFace"></span>

</template>

<script>
export default {
  name: 'MyFace',

  data() {
    return {
      myFace: ''
    }
  },
  mounted: function(){
    this.$http.get('wp/v2/svgs/name').then(response => {
      this.myFace = response.data
      console.log('face')
    }, () => {
      console.log('failedddd')
    });
  }
}
</script>
