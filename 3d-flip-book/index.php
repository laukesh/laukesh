<?php
if (isset($_GET['path']))
{
	$path = $_GET['path'];
}
else
{
	$path = "http://103.241.181.83:8082/sainik_samachar/sainik-patrika/uploads/sainik_samachar/2021/12/User_Manual.pdf";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Debugging</title>
    <meta charset="utf-8">
  </head>
  <body>

    <style type="text/css">
      body {
        background-color: #333;
        margin: 0;
        padding: 0;
      }
      .container {
        height: 95vh;
        width: 95%;
        margin: 20px auto;
        //border: 2px solid red;
        //box-shadow: 0 0 5px red;
      }
      .fullscreen {
        background-color: #333;
      }
    </style>

    <div class="container" id="container">

    </div>

    <script src="js/libs/jquery.min.js"></script>
    <script src="js/libs/html2canvas.min.js"></script>
    <script src="js/libs/three.min.js"></script>
    <script src="js/libs/pdf.min.js"></script>

    <script src="js/dist/3dflipbook.js"></script>
    <script type="text/javascript">

      // // Sample 0 {
       $('#container').FlipBook({
         pdf: '<?php echo $path; ?>',
         template: {
           html: 'templates/default-book-view.html',
           styles: [
             'css/short-black-book-view.css'
           ],
           links: [
             {
               rel: 'stylesheet',
               href: 'css/font-awesome.min.css'
             }
           ],
           script: 'js/default-book-view.js'
         }
      });
      // // }

      // Sample 1 {
     /* function theKingIsBlackPageCallback(n) {
        return {
          type: 'image',
          src: 'books/image/theKingIsBlack/'+(n+1)+'.jpg',
          interactive: false
        };
      }

      $('#container').FlipBook({
        pageCallback: theKingIsBlackPageCallback,
        pages: 40,
        propertiesCallback: function(props) {
          props.cover.color = 0x000000;
          return props;
        },
        template: {
          init: 'safari-fa-init.html',
          html: 'templates/default-book-view.html',
          styles: [
            'css/short-white-book-view.css'
          ],
          links: [
            {
              rel: 'stylesheet',
              href: 'css/font-awesome.min.css'
            }
          ],
          script: 'js/default-book-view.js',
          sounds: {
            startFlip: 'sounds/start-flip.mp3',
            endFlip: 'sounds/end-flip.mp3'
          }
        }
      });*/
      // }

      // // Sample 2 {
      // function preview(n) {
      //   return {
      //     type: 'html',
      //     src: 'books/html/preview/'+(n%3+1)+'.html',
      //     interactive: true
      //   };
      // }
      //
      // $('#container').FlipBook({
      //   pageCallback: preview,
      //   pages: 20,
      //   propertiesCallback: function(props) {
      //     props.sheet.color = 0x008080;
      //     props.cover.padding = 0.002;
      //     return props;
      //   },
      //   template: {
      //     html: 'templates/default-book-view.html',
      //     styles: [
      //       'css/black-book-view.css'
      //     ],
      //     links: [
      //       {
      //         rel: 'stylesheet',
      //         href: 'css/font-awesome.min.css'
      //       }
      //     ],
      //     script: 'js/default-book-view.js'
      //   }
      // });
      // // }

    </script>

  </body>
</html>
