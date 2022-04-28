<?php 
add_shortcode('myslider','mySlider');
function mySlider(){
?>
<div class="slider-container">
	<div class="mycarousel">
		<div class="myslider">
			<section class="mySection section1"></section>
			<section class="mySection section2"></section>
			<section class="mySection section3"></section>
			<section class="mySection section4"></section>
			<section class="mySection section5"></section>
		</div>
	</div>
	<div class="myControls">
		<span class="arrow prev"><i class="fa-solid fa-chevron-left"></i></span>
		<span class="arrow next"><i class="fa-solid fa-chevron-right"></i></span>
	</div>
</div>


<style>
	.slider-container{
		width:100%;
		margin:0 auto;
		height:50vh;
	}
	
	.mycarousel{
		width:100%;
		height:100%;
		border-radius:20px;
		display:flex;
		justify-content:flex-start;
		position:relative;
		background:white;
		overflow:hidden;
	}
	
	.myslider{
		display:flex;
		height:100%;
		width:500%;
		flex-shrink:0;
		transition:all 0.5s;
	}
	
	.mySection{
		flex-basis:20%;
		flex-shrink:0;
		width:20%;
		flex:1;
		display:flex;
		align-items:center;
		justify-content:center;
		background-size:cover;
		background-repeat:no-repeat;
		background-position:center center;
	}
	
	.section1{
		background-image:url('/wp-content/uploads/2022/01/our_services_01.jpg');
	}
	
	.section2{
		background-image:url('/wp-content/uploads/2022/01/shaving.jpg');
	}
	
	.section3{
		background-image:url('/wp-content/uploads/2022/01/ear_cleaning.jpg');
	}
	
	.section4{
		background-image:url('/wp-content/uploads/2022/01/banner_book_appointment.jpg');
	}
	
	.section5{
		background-image:url('/wp-content/uploads/2022/01/banner_about_us.jpg');
	}
	.arrow{
		position:absolute;
		top:50%;
		transform:translateY(-50%);
		font-size:18px;
		border-radius:20px;
		padding:10px 15px;
		text-align:center;
		background-color:black;
		font-family: var( --e-global-typography-064987c-font-family ), Sans-serif;
    	font-size: var( --e-global-typography-064987c-font-size );
    	font-weight: var( --e-global-typography-064987c-font-weight );
    	line-height: var( --e-global-typography-064987c-line-height );
		color: var( --e-global-color-6bdc123 );
		cursor:pointer;
	}
	.arrow i{
		font-style:normal;
		font-family:"Font Awesome 5 Free";
	}
	.arrow.prev{
		left:20px;
	}
	
	.arrow.next{
		right:20px;
	}
</style>

<script>
	const slider = document.querySelector('.myslider');
	const prev = document.querySelector('.prev');
	const next = document.querySelector('.next');
	const carousel = document.querySelector('.mycarousel');
	let direction = 1;
	
	next.addEventListener('click', function() {
  		direction = -1;
  		carousel.style.justifyContent = 'flex-start';
  		slider.style.transform = 'translate(-20%)';  
	});

	prev.addEventListener('click', function() {
  		if (direction === -1) {
    		direction = 1;
    		slider.appendChild(slider.firstElementChild);
  		}
  		carousel.style.justifyContent = 'flex-end';    
  		slider.style.transform = 'translate(20%)';  
	});

	slider.addEventListener('transitionend', function() {
  		if (direction === 1) {
    		slider.prepend(slider.lastElementChild);
  		} 
		else {
    		slider.appendChild(slider.firstElementChild);
  		}
  
  		slider.style.transition = 'none';
  		slider.style.transform = 'translate(0)';
  		setTimeout(() => {
    		slider.style.transition = 'all 0.5s';
  		})
		}, false);
		//Auto Slide
	setInterval(function(){
  		if(direction === 1){
   			direction = -1;
   			slider.prepend(slider.lastElementChild);  			
		}
  		carousel.style.justifyContent = 'flex-start';
  		slider.style.transform = 'translate(-20%)';  
	},5000);
</script>
<?php
}