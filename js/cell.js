var call = function(src, handler){var base = document.getElementsByTagName("script")[0];var obj = document.createElement("script");obj.async = true;obj.src= src;if(obj.addEventListener){obj.onload = function () {handler();}}else{obj.onreadystatechange = function () {if ("loaded" == obj.readyState || "complete" == obj.readyState){obj.onreadystatechange = null;handler();}}}base.parentNode.insertBefore(obj,base);};