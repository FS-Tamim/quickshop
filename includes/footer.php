<style>
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

.footermain{
    background-color:#181818  ;
    
}
.footercontainer{
    background-color:#181818 ;
    color: white;  
}
.main-content{
  display: flex;
}
.main-content .box{
  flex-basis: 50%;
  padding: 10px 20px;
}
.box h2{
  font-size: 1.125rem;
  font-weight: 600;
  text-transform: uppercase;
}
.box .content{
  margin: 20px 0 0 0;
  position: relative;
}
.box .content:before{
  position: absolute;
  content: '';
  top: -10px;
  height: 2px;
  width: 100%;
  background: #FFD300;
}
.box .content:after{
  position: absolute;
  content: '';
  height: 2px;
  width: 15%;
  background: #FFD300;
  top: -10px;
}
.left .content p{
  text-align: justify;
}
.left .content .social{
  margin: 20px 0 0 0;
}
.left .content .social a{
  padding: 0 2px;
}
.left .content .social a span{
  color: white;
  height: 40px;
  width: 40px;
  background: #1a1a1a;
  line-height: 40px;
  text-align: center;
  font-size: 18px;
  border-radius: 5px;
  transition: 0.3s;
}
.left .content .social a span:hover{
  background: #F9A602;
}
.center .content .fas{
  font-size: 1.4375rem;
  background: #1a1a1a;
  height: 45px;
  width: 45px;
  line-height: 45px;
  text-align: center;
  border-radius: 50%;
  transition: 0.3s;
  cursor: pointer;
}
.center .content .fas:hover{
  background: #F9A602;
}
.center .content .text{
  font-size: 1.0625rem;
  font-weight: 500;
  padding-left: 10px;
}
.center .content .phone{
  margin: 15px 0;
}
.write-message,.writeemail{
  width: 100%;
  font-size: 1.0625rem;
  border-radius: 10px;
  background: #282828;
  padding-left: 10px;
  border: 1px solid #222222;
  color: white;
}
.message-btn{
    margin-top: 3%;
    width: 30%;
}

.right form input{
  height: 35px;
}


.bottom{
  padding: 5px;
  font-size: 0.9375rem;
  background: #181818;
}
.bottom span{
  color: #656565;
}
.bottom a{
  color: #FFD300;
  text-decoration: none;
}
.bottom a:hover{
  text-decoration: underline;
}
@media screen and (max-width: 900px) {
  .main-content{
    flex-wrap: wrap;
    flex-direction: column;
  }
  .main-content .box{
    margin: 5px 0;
  }
}

</style>
<div class="footermain">
<div class="container footercontainer">
<div class="main-content">
        <div class="left box">
          <h2>
About us</h2>
<div class="content">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima fuga sint, dolorem accusantium, debitis fugit doloribus corporis eaque consectetur magni sit natus blanditiis corrupti animi sapiente saepe iure fugiat tempore!
           .</p>
<div class="social">
              <a href="#"><span class="fab fa-facebook-f"></span></a>
              <a href="#"><span class="fab fa-twitter"></span></a>
              <a href="#"><span class="fab fa-instagram"></span></a>
              <a href="#"><span class="fab fa-youtube"></span></a>
            </div>
</div>
</div>
<div class="center box">
          <h2>
Address</h2>
<div class="content">
            <div class="place">
              <span class="fas fa-map-marker-alt"></span>
              <span class="text">Demra,Dhaka</span>
            </div>
<div class="phone">
              <span class="fas fa-phone-alt"></span>
              <span class="text">01689648466</span>
            </div>
<div class="email">
              <span class="fas fa-envelope"></span>
              <span class="text">abc@example.com</span>
            </div>
</div>
</div>

<div class="right box">
          <h2>Contact us</h2>
         <div class="content">
        <form action="#">
        <div class="email">
                <div class="text">Email *</div>
                <input type="email" class="writeemail" required>
        </div>
        <div class="msg">   
                <div class="text">Message *</div>
                <textarea class="write-message"></textarea>
       </div>    
        <div>
        <button class="btn btn-warning message-btn" type="submit">Send</button>
        </div>
    </form>
</div>
</div>
</div>



<div class="bottom text-center">
       
          <span class="far fa-copyright"></span> 2020 All rights reserved.
</div>


</div>
</div>




</body>
</html>