#!/usr/local/bin/php
<?php
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Mandelbrot Explorer</title>
<meta charset="utf-8"/>
<link type="text/css" href="css/mandelbrot.css" rel="stylesheet"/>
<script src="js/mb_lib.js" type="text/javascript"></script>
</head>

<body>
	<div id="wrapper_block">
		<div id="header_block">
		</div>
		<div id="main_block">
			<div id="image_block">
	<canvas id="canvas" width="800" height="600">
      Your browser does not support the <code>canvas</code> element
    </canvas>
	<script>
	var canvas_width = 800; // use jQuery to get this??
	var canvas_height = 600;
	var ctx = document.getElementById("canvas").getContext("2d");
	ctx.fillStyle = "#ffbbee";
	ctx.fillStyle = "#770";
	//console.log(ctx);

	//var mm = mb2(-1.5, -0.5, 0.666363663, 1.0, 64, 64);
	//var mm = mb2(-1.5, -0.5, 0.666363663, 1.0, 800, 600);
	//var mmlen = mm.data.length;
	//for (var i = 0; i < mmlen; i++) {
	//	console.log(mm.data[i]);
	//}
	var cm = tri_square_palette();
	var cm_sz = cm.len;
	var cm_r = cm.r;
	var cm_b = cm.b;
	var cm_g = cm.g;

	//
	// 2. display colormap
	//
	if (false) {
		var img = ctx.createImageData(800, 600);
		var data = img.data;
		var data_len = img.data.length;
		var r =       0;
		var g =       0;
		var b =       0;
		var alpha = 255;
		var cmi = 0;
		var di = 0;
		for (var y = 0; y < canvas_height; y++) {
			//cmi = y % 100;
			//cmi = (y/2) % 100;
			if ((y%4) == 1)
				++cmi;
			if (cmi == 100)
				cmi = 0;
			r = cm_r[cmi];
			g = cm_g[cmi];
			b = cm_b[cmi];
			for (var x = 0; x < canvas_width; x++) {
				img.data[di++] = r;
				img.data[di++] = g;
				img.data[di++] = b;
				img.data[di++] = alpha;
			}
		}
		ctx.putImageData(img, 0, 0);
	}

	//
	// 3. display Mandelbrot set
	//
	if (true) {
		var img = ctx.createImageData(800, 600);
		var data = img.data;
		var data_len = img.data.length;

		// complex plane coordinates
		var cp_x0 = -2.05;
		var cp_y0 = -1.2;
		var cp_incr = 0.00353234302;
		var cp_x = cp_x0;
		var cp_y = cp_y0;

		var r =       0;
		var g =       0;
		var b =       0;
		var alpha = 255;

		var cmi = 0;
		var di = 0;
		for (var y = 0; y < canvas_height; y++) {
			if ((y%4) == 1)
				++cmi;
			if (cmi == 100)
				cmi = 0;
			r = cm_r[cmi];
			g = cm_g[cmi];
			b = cm_b[cmi];
			cp_x = cp_x0;
			for (var x = 0; x < canvas_width; x++) {
				var mb = mb0(cp_x, cp_y);

				// new
				r = cm_r[mb];
				g = cm_g[mb];
				b = cm_b[mb];
				
				img.data[di++] = r;
				img.data[di++] = g;
				img.data[di++] = b;
				img.data[di++] = alpha;
				cp_x += cp_incr;
			}
			cp_y += cp_incr;
		}
		ctx.putImageData(img, 0, 0);
	}

	//
	// 1. random colors, used prior to 09/10/2013
	//
	if (false) {
		var r = 255;
		var g =   0;
		var b =   100;
		var alpha = 255;
		for (i = 0; i < data_len; i++) {

		// write pixels to image
		var d = 0;
		if ((i%4) == 0) {
			d = r;
		}
		else if ((i%4) == 1) {
			d = g;
		}
		else if ((i%4) == 2) {
			d = b;
		}
		else if ((i%4) == 3) {
			d = alpha;
		}
		img.data[i] = d;
	
		// generate pixels
		if (!(i%6657)) {
			r -= 1;
			if (r == 0)
			r = 255
		}
		if (!(i%5131)) {
			g += 1;
			if (g == 255)
				g = 0;
		}
		if (!(i%2317)) {
			if (b == 255) {
				b = 0;
			}
			b += 1;
		}
	}

		img.data[0] = 254;
		img.data[3] = 254;

		img.data[4] = 254;
		img.data[7] = 254;

		img.data[8] = 254;
		img.data[11] = 254;
	
		img.data[12] = 254;
		img.data[15] = 254;
	}

	//ctx.putImageData(img, 16, 16);
	ctx.putImageData(img, 0, 0);

    </script>
			</div>
			<div id="sidebar_block">
			</div>
		</div>
		<div id="footer_block">
		</div>
	</div>
</body>

</html>

