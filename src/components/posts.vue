<template>
  <div class="main-content">

    <ul class="main-nav">
      <li class="main-nav__item" ref="mainnavitem" v-for="(item, index) in items" :key="index" v-html="item.message" :data-postIndex="index+2" v-on:click="bounce(item); thisPost(item);" v-bind:class="{'main-nav__item--bouncing': itemActive[index]}">
      </li>
    </ul>
    <div class="ssl-warning" v-bind:class="{ active: isActive }">
      <p>Sorry, I didn't want to pay godaddy $75 for SSL so you'll need to allow your browser from unauthenticated sources</p>
    </div>
    <div class="col-xs-12 text-center info" :class="{'info--sliding-right': slidingRight, 'info--sliding-left': slidingLeft, 'info--sliding-up': slidingUp}">
      <transition name="slide-fade">
        <span v-if="content[this.selectedIndex]">
          <h1 class="init-header" v-html="items[this.selectedIndex].message"></h1>
        </span>
        <span v-else>
          <h1 class="init-header" v-if="show" v-html="introMessage"></h1>
        </span>
      </transition>
      <span class="info__left-arrow" v-on:click="prevPost"></span>
      <div class="info__content" v-if="content[this.selectedIndex]">

        <div v-html="content[this.selectedIndex][0].contentMain"></div>
        <ul v-if="content[this.selectedIndex][1]" class="info__list">
          <li v-for="(post, postIndex) in content[this.selectedIndex][1].repstuff" :key="postIndex" class="info__list__item" v-on:click="openModal(postIndex)">
            <div class='info__popup__preview'>
              <div class="thumbnail-container" :style="{backgroundImage:`url(' ${post.featured_image_url} ')` }  " style="background-size: cover; background-position: center center; background-repeat:no-repeat"></div>
              <h4 v-html="post.post_title"></h4>
            </div>
            <section class='info__popup' :class="{'info--show-popup':modalOpen[postIndex]}" :ref="'popup-'+postIndex"><span class='x-close'></span><div v-html="post.post_content"></div></section>
          </li>
        </ul>

      </div>
        <span class="info__right-arrow" v-on:click="nextPost"></span>
    </div>

    <div class="modal-background" :class="{'modal-background--open': modalBackground }" v-on:click="closeModal"></div>
  </div>
</template>

<script>


export default {
  components: {
    // HelloWorld,
    // MyName,
    // MyFace
  },
  data: function() {
    return{
      items: [],
      content: [],
      itemActive: [],
      repeatablesAutocomplete: [],
      isActive: false,
      show: true,
      selectedIndex: '',
      introMessage:  'Hiyo',
      modalOpen: [],
      modalBackground: false,
      slidingRight: false,
      slidingLeft: false,
      slidingUp: false,
      // myName: '',
      // myFace: '',
      // myPhoto: ''
    }
  },
  mounted: function(){
    let dt= Date.now();
		// vm.$http.get( 'wp-api-menus/v2/menu-locations/primary-menu' )
    this.$http.get(`wp/v2/hot_sauces?filter[orderby]=date&order=asc&datenow=${dt}`).then(response => {
      let x = this;
			// console.log(response)
      response.data.forEach(function(val){
        x.items.push({message: val.title.rendered})
        x.itemActive.push(false)
        let repeatables = JSON.parse( val.repeatable_autocomplete );
        if (repeatables){
          x.content.push([{contentMain: val.content.rendered},{repstuff: repeatables}])
        }
        else {
          x.content.push( [{contentMain: val.content.rendered}])
        }
      })
      // console.log(x.content)
      if (this.selectedIndex == false){
        setTimeout(() => {
          this.$refs.mainnavitem[0].click()
        }, 500);
      }
    }, () => {
      console.log('sorry about that');
      this.isActive = true;
      // error callback
    });

  },
  methods: {
    dontBounce: function(){
      let i = 0
      // reset all itemActive properties back to false
      while (i < this.items.length){
        this.itemActive[i] = false
        i++
      }
    },
    bounce: function(item){
      let itemInd = this.items.indexOf(item)
      this.dontBounce()
      this.itemActive[itemInd] = true
    },
    thisPost: function (item){
      // this.introMessage = item.message;
      // this.selectedIndex = this.items.indexOf(item);
      this.slidingUp = true;
      let i = item.message;
      let s = this.items.indexOf(item);

      let x = this;
      setTimeout(function(){
        console.log('hi');
        x.introMessage = i;
        x.selectedIndex = s;
      }, 1500);
      setTimeout(function(){
        x.slidingUp = false;
      }, 2500);
    },
    nextPost: function () {
      let thisNext = this
      thisNext.slidingRight = true
      setTimeout(function(){
        let count = thisNext.items.length
        thisNext.selectedIndex++;
        if (thisNext.selectedIndex > (count-1)){
          thisNext.selectedIndex = 0
        }
        thisNext.dontBounce()
        thisNext.itemActive[thisNext.selectedIndex] = true
      }, 1500)
      setTimeout(function(){
        thisNext.slidingRight = false
      }, 3000)
    },
    prevPost: function () {
      let thisPrev = this
      thisPrev.slidingLeft = true
      setTimeout(function(){
        let count = thisPrev.items.length
        thisPrev.selectedIndex--;
        if (thisPrev.selectedIndex < 0){
          thisPrev.selectedIndex = count-1
        }
        thisPrev.dontBounce()
        thisPrev.itemActive[thisPrev.selectedIndex] = true
      }, 1500)
      setTimeout(function(){
        thisPrev.slidingLeft = false
      }, 3000)
    },
    openModal: function (postIndex) {
      this.modalBackground = true;
      this.modalOpen[postIndex]= true;
      console.log(this.modalOpen)
    },
    closeModal: function () {
      this.modalOpen=[];
      this.modalBackground = false;
      console.log(this.modalOpen)
    },
    initClick: function () {
      setTimeout(() => {
        this.$refs.mainnavitem[0].click()
        // this.bounce(this.items[0])
        // this.thisPost(this.items[0])
      }, 1000);
    },
  },


}
</script>


<!-- <template>

	<transition name="slide-fade">

		<div class="row rt-main postss" v-if="loaded === 'true'" >

			<div class="medium-12 small-12 column rt-pagination">
					<a href=""  v-if="showPrev" v-on:click.prevent="rtShowPrev()"> &LT; prev  </a>
					<a > {{ currentPage }} / {{ totalPages }} </a>
					<a href=""  v-if="showNext" v-on:click.prevent="rtShowNext()"> more &GT; </a>
			</div>

			<div class="medium-12 small-12 column" v-for="post in posts" :key="post.slug">

				<div class="rt-post">

					<h2 class="rt-post-title"><router-link :to="{ name: 'post', params: { name:post.slug }}"> {{ post.title.rendered }} </router-link> </h2>
					<div class="rt-meta">
						<span class="posted-on">
							Posted On
							<span class="date" v-text="formatDate( post )">
							</span>
						</span>
					</div>

					<div class="progressive full" v-if="post.featured_image_src['full'][0]">

						<img class="lazy" v-progressive="post.featured_image_src['full'][0]" :data-srcset="post.featured_image_src['srcset']" :src="post.featured_image_src['full'][0]" />

					</div>

					<div class="rt-post-excerpt rt-content" v-html="post.excerpt.rendered" > </div>

				</div>

			</div>

		</div>

	</transition>

</template>

<script>
export default {

	mounted: function() {

		const vm = this;

		if ( vm.$route.params.page ) {

			vm.getPosts( vm.$route.params.page );

		} else {

			vm.getPosts();
		}

	},
	data() {

		return {

			posts: {},
			currentPage: '',
			prevPage: '',
			nextPage: '',
			showNext: 'true',
			showPrev: 'true',
			postCollection: '',
			postPerPage: '10',
			totalPages: '',
			loaded: 'false',
			pageTitle: ''

		};

	},

	methods: {

		getPosts: function( pageNumber = 1 ) {

			const vm = this;
			vm.loaded = 'false';
			vm.$http.get( 'wp/v2/posts', {
				params: { per_page: vm.postPerPage, page: pageNumber }
			} )
			.then( ( res ) => {
				vm.posts = res.data;
				vm.totalPages = res.headers[ 'x-wp-totalpages' ];

				if ( pageNumber <= parseInt( vm.totalPages ) ) {

					vm.currentPage = parseInt( pageNumber );

				} else {

					vm.$router.push( { 'name': 'home' } );
					vm.currentPage = 1;

				}

				vm.loaded = 'true';
				vm.pageTitle = 'Blog';
				vm.$store.commit( 'rtChangeTitle', vm.pageTitle );

			} )
			.catch( ( res ) => {
				//console.log( `Something went wrong : ${ res }` );
			} );

		},
		rtShowNext: function( event ) {

			const vm = this;

			if ( vm.currentPage < vm.totalPages ) {

				vm.currentPage = vm.currentPage + 1;

				vm.$router.push( { 'name': 'home', params: { 'page': vm.currentPage } } );
			}
		},
		rtShowPrev: function( event ) {

			const vm = this;
			if ( vm.currentPage != 1 ) {

				vm.currentPage = vm.currentPage - 1;

				vm.$router.push( { 'name': 'home', params: { 'page': vm.currentPage } } );

			}
		},
		formatDate: function( value ) {

			value = value.date;
			if ( value ) {
				const date = new Date( value );
				const monthNames = [ "January", "February", "March",
					"April", "May", "June", "July",
					"August", "September", "October",
					"November", "December" ];

				const day = date.getDate();
				const monthIndex = date.getMonth();
				const year = date.getFullYear();

				return monthNames[ monthIndex ] + ',' + day + ' ' + year;
			}

		}

	},
	watch: {

		'$route'( to, from ) {
			this.getPosts( this.$route.params.page );
		}

	}
};
</script> -->
