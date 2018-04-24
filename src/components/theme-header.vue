<template>

    <section class="svgs">
      <!-- <MyName v-html="myName"/>
      <MyFace v-html="myFace"/> -->
      <!-- <span v-html="myName"></span> -->
      <!-- <span v-html="myPhoto"></span> -->
			<MyName v-html="myName"/>
			<MyFace v-html="myFace"/>

    </section>

</template>

<script>
// import HelloWorld from './components/HelloWorld.vue'
// import MyName from './components/NameSVG.vue'
import MyFace from './FaceSVG.vue'
import MyName from './NameSVG.vue'

export default {

  components: {
    // HelloWorld,
    MyName,
    MyFace
  },
  data: function() {
    return{
      // items: [],
      // content: [],
      // itemActive: [],
      // repeatablesAutocomplete: [],
      // isActive: false,
      // show: true,
      // selectedIndex: '',
      // introMessage:  'Hiyo',
      // modalOpen: [],
      // modalBackground: false,
      // slidingRight: false,
      // slidingLeft: false,
      // slidingUp: false,
      myName: '',
      myFace: '',
      myPhoto: ''
    }
  },
  // mounted: function(){
  //   let dt= Date.now();
	// 	// vm.$http.get( 'wp-api-menus/v2/menu-locations/primary-menu' )
  //   this.$http.get(`wp/v2/hot_sauces?filter[orderby]=date&order=asc&datenow=${dt}`).then(response => {
  //     let x = this;
	// 		// console.log(response)
  //     response.data.forEach(function(val){
  //       x.items.push({message: val.title.rendered})
  //       x.itemActive.push(false)
  //       let repeatables = JSON.parse( val.repeatable_autocomplete );
  //       if (repeatables){
  //         x.content.push([{contentMain: val.content.rendered},{repstuff: repeatables}])
  //       }
  //       else {
  //         x.content.push( [{contentMain: val.content.rendered}])
  //       }
  //     })
  //     // console.log(x.content)
  //     if (this.selectedIndex == false){
  //       setTimeout(() => {
  //         this.$refs.mainnavitem[0].click()
  //       }, 500);
  //     }
  //   }, () => {
  //     console.log('sorry about that');
  //     this.isActive = true;
  //     // error callback
  //   });
  //
  // },
  // methods: {
  //   dontBounce: function(){
  //     let i = 0
  //     // reset all itemActive properties back to false
  //     while (i < this.items.length){
  //       this.itemActive[i] = false
  //       i++
  //     }
  //   },
  //   bounce: function(item){
  //     let itemInd = this.items.indexOf(item)
  //     this.dontBounce()
  //     this.itemActive[itemInd] = true
  //   },
  //   thisPost: function (item){
  //     // this.introMessage = item.message;
  //     // this.selectedIndex = this.items.indexOf(item);
  //     this.slidingUp = true;
  //     let i = item.message;
  //     let s = this.items.indexOf(item);
  //
  //     let x = this;
  //     setTimeout(function(){
  //       console.log('hi');
  //       x.introMessage = i;
  //       x.selectedIndex = s;
  //     }, 1500);
  //     setTimeout(function(){
  //       x.slidingUp = false;
  //     }, 2500);
  //   },
  //   nextPost: function () {
  //     let thisNext = this
  //     thisNext.slidingRight = true
  //     setTimeout(function(){
  //       let count = thisNext.items.length
  //       thisNext.selectedIndex++;
  //       if (thisNext.selectedIndex > (count-1)){
  //         thisNext.selectedIndex = 0
  //       }
  //       thisNext.dontBounce()
  //       thisNext.itemActive[thisNext.selectedIndex] = true
  //     }, 1500)
  //     setTimeout(function(){
  //       thisNext.slidingRight = false
  //     }, 3000)
  //   },
  //   prevPost: function () {
  //     let thisPrev = this
  //     thisPrev.slidingLeft = true
  //     setTimeout(function(){
  //       let count = thisPrev.items.length
  //       thisPrev.selectedIndex--;
  //       if (thisPrev.selectedIndex < 0){
  //         thisPrev.selectedIndex = count-1
  //       }
  //       thisPrev.dontBounce()
  //       thisPrev.itemActive[thisPrev.selectedIndex] = true
  //     }, 1500)
  //     setTimeout(function(){
  //       thisPrev.slidingLeft = false
  //     }, 3000)
  //   },
  //   openModal: function (postIndex) {
  //     this.modalBackground = true;
  //     this.modalOpen[postIndex]= true;
  //     console.log(this.modalOpen)
  //   },
  //   closeModal: function () {
  //     this.modalOpen=[];
  //     this.modalBackground = false;
  //     console.log(this.modalOpen)
  //   },
  //   initClick: function () {
  //     setTimeout(() => {
  //       this.$refs.mainnavitem[0].click()
  //       // this.bounce(this.items[0])
  //       // this.thisPost(this.items[0])
  //     }, 1000);
  //   },
  // },


}
</script>
<!-- <template>

	<header id="masthead" class="site-header" role="banner">

		<div class="row">


			<div class="column large-10 medium-10 small-10">

				<router-link :to="{ name: 'home'}" class="site-name"> {{ site_name }} </router-link>

			</div>

			<div class="column large-2 medium-2 small-2 end">

				<a id="nav-icon1" v-on:click="toggleMenu" v-bind:class="{open: isActive}">
					<div></div>
					<div></div>
					<div></div>
				</a>

				<nav id="site-navigation" v-bind:class="{open: isActive}">

					<ul>
						<li v-for="item in menus" v-if="item.type != 'custom'">
							 <router-link :to="{ name: 'page', params: { name: getUrlName( item.url ) }}"> {{ item.title }} </router-link>
						</li>

					</ul>

				</nav>

			</div>

		</div>

	</header>

</template>

<script>
export default {

	mounted: function() {

		//console.log( wp.api.collections );
		this.getMenu();
	},
	data() {
		return {

			menus: [],
			site_name: rtwp.site_name,
			isActive: false

		};
	},
	methods: {

		getMenu: function() {

			const vm = this;

			vm.$http.get( 'wp-api-menus/v2/menu-locations/primary-menu' )
			.then( ( res ) => {
				vm.menus = res.data;
			} )
			.catch( ( res ) => {
				//console.log( `Something went wrong : ${ res }` );
			} );

		},
		getUrlName: function( url ) {

			const array = url.split( '/' );
			return array[ array.length - 2 ];
		},
		toggleMenu: function() {
			//console.log("Clicked" + this.isActive);
			this.isActive = ! this.isActive;
		}

	}
};
</script>

<style>


</style> -->
