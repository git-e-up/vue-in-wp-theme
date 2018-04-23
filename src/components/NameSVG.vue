<template>

  <span v-html="myName"></span>

</template>

<script>
export default {
  name: 'MyName',

  data() {
    return {
      myName: ''
    }
  },
  mounted: function(){
    this.$http.get('wp/v2/svgs/matthew').then(response => {

      this.myName = response.data
    }, () => {
      console.log('failedddd')
    });
  }
}
</script>
