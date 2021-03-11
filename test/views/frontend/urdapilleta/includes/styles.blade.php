<style>
    .owl-carousel {
         display: none;
         width: 90% !important;
         z-index: 1;
     }
     .container-1 {
  
         margin: 0 auto;
         padding: 20px;
         max-width: 1200px;
         overflow-y: scroll;
         font-family: "Open Sans", sans-serif;
         font-weight: 400;
         color: #777;
         background-color: #f7f7f7;
         -webkit-font-smoothing: antialiased;
         -webkit-text-size-adjust: 100%;
         -ms-text-size-adjust: 100%;
  
 
     }
     .content-1 {
         padding: 15px;
         overflow: hidden;
         background-color: #e7e7e7;
         background-color: rgba(0, 0, 0, 0.06);
     }
    
     .load-wrapp1 {
         display: flex;
         align-items: center;
         justify-content: center;
         float: left;
         width: 100%;
         height: auto;
         margin: 0 10px 10px 0;
         padding: 20px 20px 20px;
         border-radius: 5px;
         text-align: center;
         background-color: #fff;
     }
     .load-wrapp2 {
         display: flex;
         align-items: center;
         justify-content: center;
         float: left;
         width: 100px;
         height: auto;
         margin: 0 10px 10px 0;
         padding: 20px 20px 20px;
         border-radius: 5px;
         text-align: center;
         background-color: #fff;
     }
     .load-wrapp2 p {
         padding: 0 0 20px;
     }
     .load-wrapp2:last-child {
         margin-right: 0;
     }
 
     .load-wrapp1 p {
         padding: 0 0 20px;
     }
     .load-wrapp1:last-child {
         margin-right: 0;
     }
 
     .line1 {
         display: inline-block;
         width: 15px;
         height: 15px;
         border-radius: 15px;
         background-color: #4b9cdb;
     }
     .load-32 .line1:nth-last-child(1),  {
         animation: loadingC 0.6s 0.1s linear infinite ;
     }
     .load-32 .line1:nth-last-child(2) {
         animation: loadingC 0.6s 0.2s linear infinite;
     }
     .load-32 .line1:nth-last-child(3) {
         animation: loadingC 0.6s 0.3s linear infinite;
     }
     .load-31 .line1:nth-last-child(1),  {
         animation: loadingC 0.6s 0.1s linear infinite ;
     }
     .load-31 .line1:nth-last-child(2) {
         animation: loadingC 0.6s 0.2s linear infinite;
     }
     .load-31 .line1:nth-last-child(3) {
         animation: loadingC 0.6s 0.3s linear infinite;
     }
     @keyframes loadingC {
         0 {
             transform: translate(0, 0);
         }
         50% {
             transform: translate(0, 15px);
         }
         100% {
             transform: translate(0, 0);
         }
     }
 
 </style>