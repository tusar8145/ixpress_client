<?php
	
	$data=$_POST['w3review'];
    $doc_id=$_POST['doc_id'];
	
	include('config.php');
	
    $query2="select * from tender_documents WHERE tender_documents_id='$doc_id'";
	$result2=mysqli_query($connect,$query2);  $rowcount2=mysqli_num_rows($result2); $row2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
	for($k=$rowcount2-1;$k>=0;$k--)
	{  
		 	 $tl=$row2[$k]['tl'];
		 	 $tc=$row2[$k]['tc'];
		 	 $tr=$row2[$k]['tr'];
			 
		 	 $bl=$row2[$k]['bl'];
		 	 $bc=$row2[$k]['bc'];
		 	 $br=$row2[$k]['br'];
		 	 $tender_documents=$row2[$k]['tender_documents'];
	 
	}	
	?>

<html>
<head>
    <title><?php echo $tender_documents;?></title>

    <script>
        this.ready = new Promise(function ($) {
            document.addEventListener('DOMContentLoaded', $, {
                once: true
            })
        })
    </script>
    <script src="https://unpkg.com/pagedjs/dist/paged.js"></script>
	<style>

           
        :root {
            --doc-title: "<?php echo $tl; ?>";
        }
        @page {
            size: A4;

            @top-center {
                content: env(doc-title);
            }

	            @bottom-left {
                content: "<?php echo $bl; ?>";
            }		
			@top-right {
                content: "11" !important;
            }
        }


.extra-border{
	border:1px solid black !important;
}


        @page {
            @top-left {
                content: "ssSample Print Test Document" !important;
            }

            @top-center {
                content: "<?php echo $tc; ?>" !important;
            }
			            @top-right {
                content: "<?php echo $tr; ?>" !important;
            }
        }
 

        td.cell-red {
            background-color: #ff9999 !important;
        }

        td.cell-yellow {
            background-color: #ffffcc !important;
        }

        td.cell-white {
            background-color: white !important;
        }

        td.cell-green {
            background-color: #ccffcc !important;
        }

        td.cell-right p,
        td.cell-right {
            text-align: right !important;
        }

        td.cell-left p,
        td.cell-left {
            text-align: left !important;
        }

        td.cell-center p,
        td.cell-center {
            text-align: center !important;
        }

        td.cell-justify p,
        td.cell-justify {
            text-align: justify !important;
        }

        td.cell-center ul,
        td.cell-left ul,
        td.cell-right ul,
        td.cell-justify ul,
        td.cell-center ol,
        td.cell-left ol,
        td.cell-right ol,
        td.cell-justify ol {
            display: inline-block;
        }








        /** Fonts -------------------------------------- **/

        @import url("https://use.fontawesome.com/releases/v5.7.2/css/solid.css");
        @import url("https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700|PT+Sans:400,400i,700&subset=latin-ext");

        /****align image center********/
        /* To center align the image and figcaption if image is center aligned */
        .aligned-center img {
            margin-left: auto !important;
            margin-right: auto !important;
            display: block;
        }

        .aligned-center figcaption {
            text-align: center;
        }

        .article {
            font-family: "PT Sans", serif;
            font-weight: 400;
            /*text-align: justify;*/
        
        }

        .article strong {
            font-weight: 700;
        }

        .article em {
            font-style: italic;
            font-weight: 400i;
        }

        @media screen {
            .article * {
                line-height: 1.2em;
            }

            .article,
            /* .article p *, */
            .article p,
            .article ol,
            .article ul {
                font-size: 12pt;
            }

            .footnote-container {
                font-size: 12pt;
            }
        }

        @media print {
            .article * {
                line-height: 1.2em;
            }

            .article,
            /* .article p *, */
            .article p,
            .article ol,
            .article ul {
                font-size: 11pt;
            }

            .article-part h2,
            .article-part h3 {
                padding-top: 4pt
            }

            .article table th p {
                font-size: 11pt;
            }
        }

        /** Body text -------------------------------------- **/

        .article h1,
        .article h2,
        .article h3,
        .article h4,
        .article h5,
        .article h6,
        .article p,
        .article blockquote,
        .article code,
        .article ol,
        .article ul {
            font-feature-settings: "kern"1, "liga"1, "dlig"0;
            font-kerning: normal;
           

            -webkit-hyphens: auto;
            -moz-hyphens: auto;
            hyphens: auto;

            -webkit-hyphenate-before: 2;
            -webkit-hyphenate-after: 3;
            hyphenate-lines: 3;
        }

        /** Title -------------------------------------- **/

        .article-title {
            font-family: "PT Sans Narrow", sans-serif;
            font-size: 20pt;
            font-weight: 400;
            padding-bottom: 10pt;
            padding-top: 5pt;
            color: black;
        }

        .article-title:after {
            background: #e67b96;
            content: "";
            display: block;
            height: 3pt;
            width: 40pt;
            margin-top: 3pt;
        }

        /** TOC -------------------------------------- **/
        .editor .article .table-of-contents {
            font-family: "PT Sans Narrow", sans-serif;
            font-weight: 200;
            line-height: 1.3em;
            margin-bottom: 0;
           
            color: black;
            background: none;
            margin-top: 2em;
            margin-bottom: 2em;
        }

        .article .table-of-contents h1,
        .article .table-of-contents h2,
        .article .table-of-contents h3,
        .article .table-of-contents h4,
        .article .table-of-contents h5,
        .article .table-of-contents h6 {
            font-family: "PT Sans Narrow", sans-serif;
            font-weight: 700;
            line-height: 1.3em;
            margin: 0;
            padding-top: 0.1em;
            color: black;
        }

        .article .table-of-contents h2:before,
        .article .table-of-contents h1:before {
            display: none;
        }

        .table-of-contents a {
            text-decoration: none;
            color: black;
        }

        .table-of-contents a:hover {
            text-decoration: none;
            color: #eda1b4;
        }

        .article .table-of-contents h1.toc {
            font-style: normal;
            font-weight: 400;
            font-size: 1.3em;
            color: #121212;
            padding-top: 1.5em;
            padding-bottom: 1.5em;
        }

        .article .table-of-contents h3,
        .article .table-of-contents h4,
        .article .table-of-contents h5,
        .article .table-of-contents h6 {
            display: none;
        }

        /** Special -------------------------------------- **/

        .article-part.article-deleted {
            border: 1px dotted #d3421c;
            border-radius: 0px;
            padding: 10px 35px 10px 10px;
            margin: 5px -10px;
            position: relative;
            border-left: 2px solid #d3421c;
        }

        /** Titles -------------------------------------- **/
        .article-heading_part {
            vertical-align: top;
        }

        .article h1,
        .article h2,
        .article h3,
        .article h4 {
            font-family: "PT Sans Narrow", sans-serif;
            font-weight: 700;
            line-height: 1.3em;
            margin: 0;
          
            padding-top: 3pt;
            padding-bottom: 3pt;
        }

        .article h1 {
            font-size: 18pt;
            color: #e67b96;
            font-weight: 400;
        }

        [class$="h1"] h1:before,
        [class$="h1_opt"] h1:before,
        [class$="opt_h1"] h1:before {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: .8em;
            content: "\f105  ";
            white-space: pre;
            display: inline-block;
            left: -12pt;
            position: relative;
            width: 3pt;
            
            line-height: 0;
        }

        .article h2 {
            font-size: 14pt;
            color: black;
        }

        [class$="h2"] h2:before,
        [class$="opt_h2"] h2:before,
        [class$="h2_opt"] h2:before {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: .8em;
            content: "\f101  ";
            white-space: pre;
            display: inline-block;
            left: -12pt;
            position: relative;
            width: 3pt;
             
            line-height: 0;
        }

        .article h3 {
            font-weight: 400;
            font-size: 12pt;
            color: black;
        }

        .article h4 {
            font-size: 11pt;
            color: #9e2443;
        }

        [class$="h3"] h3:before,
        [class$="h3_opt"] h3:before,
        [class$="opt_h3"] h3:before,
        [class$="h4"] h4:before,
        [class$="h4_opt"] h4:before,
        [class$="opt_h4"] h4:before {
            background: #ffffff;
            content: '';
            display: inline-block;
            height: 1em;
            top: .1em;
            left: -12pt;
            position: relative;
            width: 3pt;
             
            line-height: 0;
        }

        .article h5 {
            font-family: "PT Sans", sans-serif;
            font-weight: 700;
            color: #3e92cc;
            font-size: 11pt;
            padding-top: 0;
            padding-bottom: 0;
        }

        .article code {
            font-family: "PT Sans", sans-serif;
            font-weight: 700;
            color: #3e92cc;
            font-size: 11pt;
            padding-top: 0;
            padding-bottom: 0;
        }

        .article code::before {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 0.8em;
            content: "\f105  ";
            white-space: pre;
        }

        .article h6 {
            font-family: "PT Sans", sans-serif;
            color: black;
            font-weight: 700;
            font-size: 11pt;
            padding-top: 0;
            padding-bottom: 0;
        }

        .article-subtitle {
            font-family: "PT Sans Narrow", sans-serif;
            font-size: 16pt;
            font-weight: 400;
        }

        .article-abstract {
            margin-left: 50px;
            margin-right: 50px;
        }

        .article-part.metadata {
            margin-bottom: 20px;
        }

        /** Paragraphs, body text -------------------------------------- **/

        .article p {
            margin: 0;
            hyphens: auto;
            text-align: justify;
            color: #1e1e24;
            text-justify: inter-word !important;
            margin-bottom: 0;
            padding-bottom: 1pt;
        }

        .article p+div {
            padding-top: 6pt;
            padding-bottom: 6pt;
        }

        /** Lists -------------------------------------- **/

        .article ul,
        .article ol {
            padding-left: 2em;
        }

        .article ul {
            list-style: circle;
            color: #3e92cc;
        }

        .article ol {
            list-style: decimal;
        }

        .article blockquote {
            margin-left: 40px;
            margin-right: 40px;
            font-size: 0.8em;
            line-height: 1.3em;
        }

        /** Tables -------------------------------------- **/

        .article table {
            border-collapse: collapse;
            text-align: left;
            background: white;
            border-spacing: 0px;
            border: 0px solid white;
             
            
            margin-top: 9pt;
            margin-bottom: 9pt;
        }

        .article table td,
        .article table th {
            border: 0px;
        }

        .article table+table {
            margin-bottom: 12pt;
        }

        /*############################################################ */
        .article .table-left {
            margin-right: 9pt;
        }

        .article .table-right {
            margin-left: 9pt;
        }

        .article-table_part {
            padding-top: 6pt;
            padding-bottom: 6pt;
        }

        .article table th {
            color: #9e2443;
            background-color: #fbecf0;
          
            border-left-width: 0;
            border-right-width: 0;
            vertical-align: middle;
            padding: 4pt;
        }

        .article table th p {
            font-family: "PT Sans Narrow", serif;
            color: black;
            font-weight: 400;
            text-align: left;
            /* font-size: 11pt; */
            font-variant: small-caps;
            /* line-height: 1.2em; */
        }

        .article table tr td {
            border-left: 1pt solid #ddd;
            border-bottom: 1pt solid #ddd;
            padding: 3pt;
            vertical-align: top;
        }

        .article table tr td:first-child {
            border-left: 0px;
        }

        .article table tr:first-child td,
        .article table tr:first-child th {
            border-top: 1pt solid #ddd;
        }

        .article td p {
            text-align: left;
        }

        .article td.selectedCell {
            background-color: #faf3d4;
            z-index: 950;
        }

        .article table h4,
        .article table h5,
        .article table h6 {
            padding-top: 0;
            padding-bottom: 0;
        }

        .article table h4 {
            font-weight: 400;
            color: #0eb1d2;
            float: none;
        }

        .article table h6 {
            font-weight: 400;
        }

        /** Figures -------------------------------------- **/

        .article figure {
            border: none;
            padding: 5pt;
            padding-bottom: 2pt;
            text-align: left;
           
            cursor: pointer;
            margin: 1% 1%;
            clear: none;
            box-sizing: border-box !important;
            width: auto;
        }

        .article figcaption {
            font-family: "PT Sans Narrow", sans-serif;
            font-weight: 400;
            padding-top: 3pt;
            font-size: 9pt;
            margin: 2pt;
            color: black;
        }

        .article .figure-cat-figure,
        .article .figure-cat-photo,
        .article .figure-cat-table {
            font-family: "PT Sans Narrow", sans-serif;
            font-weight: 700;
            padding-top: 3pt;
            color: black;
        }

        .article .figure-cat-table {
            padding-bottom: 3pt;
        }

        /* Adjusted images width to reduce margin around and show equivalent dimensions as selected by user*/
        .image-width-75 {
            max-width: 73%;
        }

        .image-width-50 {
            max-width: 48%;
        }

        .image-width-25 {
            max-width: 23%;
        }

        .image-width-100 {
            max-width: 98%;
        }

        figure img {
            max-height: 240mm !important;
        }

        /* Footnotes -------------------------------------- */

        .footnote-marker,
        .citation-footnote-marker {
            font-size: 0.6em;
            line-height: 0;
            position: static;
            vertical-align: super;
            top: 0;
        }

        .footnote-container {
            font-family: "PT Sans", sans-serif;
            font-weight: 400;
            padding-left: 12pt;
            /* font-size: 12pt; */
            color: #999;
        }

        @media print {
            .article {
                margin: 0;
 
            }

            .article p {
               
                orphans: 2;
                widows: 2;
            }

            .article h1,
            .article h2,
            .article h3,
            .article h4,
            .article h5,
            .article h6 {
                padding: 0;
            }

            .article-part h1,
            .article-part h2,
            .article-part h3,
            .article-part h4,
            .article-part h5,
            .article-part h6 {
           
                padding-top: 0pt;
                padding-bottom: 0pt;
                margin-left: 0pt;
            }

            .article-part.article-deleted {
                border: none;
                border-radius: 0px;
                padding: 0;
                margin: 0;
            }


            .article table h4,
            .article table h5,
            .article table h6 {
                padding: 0;
                margin: 0;
            }

            /** Figures -------------------------------------- **/
 
            .article figcaption {
                font-family: "PT Sans Narrow", sans-serif;
                font-weight: 400;
                font-size: 9pt;
                padding-top: 0pt;
                color: black;
            }

            .article .figure-cat-figure,
            .article .figure-cat-photo,
            .article .figure-cat-table {
                font-family: "PT Sans Narrow", sans-serif;
                font-weight: 700;
                padding-top: 0pt;
                color: black;
            }

            /* General print rules -------------------------------------- */

            img {
                image-resolution: from-image;
            }

            .article .table-25 .table-center {
                margin-left: 35% !important;
            }

            .article .table-50 .table-center {
                margin-left: 24% !important;
            }

            .article .table-75 .table-center {
                margin-left: 12% !important;
            }

            .aligned-center {
                margin-left: auto !important;
                margin-right: auto !important;
            }
        }

        /* This is the definition of the page size, header and footer */
        /* Page general  --------------------------------------*/

        @page {
            size: A4;
            margin: 15mm 20mm 15mm 20mm;
            font-family: "PT Sans", sans-serif;
            background-color: white;
        }

        @page :first {}

        /* Page header  --------------------------------------*/

        @page {

            /*  Title in plugin  */
            @top-left {
                content: var(--doc-title) !important;
                white-space: nowrap;
                font-size: 9pt;
                color: #3d3d3d;
                font-family: "PT Sans Narrow", sans-serif;
            }

            /* Page footer -------------------------------------- */
         

<?php
if($br=="N/A" || $br=="n/a")
{
	echo '
		 @bottom-right {
                z-index: 100;
                content: "";
                font-size: 9pt;
                color: #3d3d3d;
                font-family: "PT Sans Narrow", sans-serif;
            }	
	';
} else {
	echo '
		 @bottom-right {
                z-index: 100;
                content: "Page "counter(page);
                font-size: 9pt;
                color: #3d3d3d;
                font-family: "PT Sans Narrow", sans-serif;
            }	
	';
}

?>

			
			

            @bottom-left {
                z-index: 100;
                content: " ";
                font-size: 9pt;
                color: #3d3d3d;
                font-family: "PT Sans Narrow", sans-serif;
            }

            @bottom-center {
                content: "" !important;
            }
				            @bottom-left {
                content: "<?php echo $bl; ?>";
            }	
			
				            @bottom-center {
                content: "<?php echo $bc; ?>";
            }				
        }

        table td {
            border-spacing: 0px !important;
            vertical-align: top;
        }


        :root {
            --color-mbox: rgba(0, 0, 0, 0.2);
            --margin: 4px;
        }

        [contenteditable]:focus {
            outline: 0px solid transparent;
        }

        #controls {
            display: none;
        }

        @media screen {

            body {
                background-color: whitesmoke;
            }

            .pagedjs_page {
                background-color: #fdfdfd;
                margin: calc(var(--margin) * 4) var(--margin);
                flex: none;
                box-shadow: 0 0 0 1px var(--color-mbox);
            }

            .pagedjs_pages {
                width: calc((var(--pagedjs-width) * 2) + (var(--margin) * 4));
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: flex-start;
                transform-origin: 0 0;
                margin: 0 auto;
            }

            #controls {
                margin: 20px 0;
                text-align: center;
                display: block;
            }

            .pagedjs_first_page {
                margin-left: calc(50% + var(--margin));
            }
        }

        @media screen {

            .debug .pagedjs_margin-top .pagedjs_margin-top-left-corner,
            .debug .pagedjs_margin-top .pagedjs_margin-top-right-corner {
                box-shadow: 0 0 0 1px inset var(--color-mbox);
            }

            .debug .pagedjs_margin-top>div {
                box-shadow: 0 0 0 1px inset var(--color-mbox);
            }

            .debug .pagedjs_margin-right>div {
                box-shadow: 0 0 0 1px inset var(--color-mbox);
            }

            .debug .pagedjs_margin-bottom .pagedjs_margin-bottom-left-corner,
            .debug .pagedjs_margin-bottom .pagedjs_margin-bottom-right-corner {
                box-shadow: 0 0 0 1px inset var(--color-mbox);
            }

            .debug .pagedjs_margin-bottom>div {
                box-shadow: 0 0 0 1px inset var(--color-mbox);
            }

            .debug .pagedjs_margin-left>div {
                box-shadow: 0 0 0 1px inset var(--color-mbox);
            }
        }


        body {
            counter-reset: figure-cat-0 figure-cat-1 figure-cat-2 footnote-counter footnote-marker-counter;
        }


        /* CSL */

        .csl-bib-body {
            padding-top: 0.5em;
            padding-bottom: 0.5em;
        }

        .csl-left-margin {
            padding-right: 1ch;
        }

        .csl-entry i {
            font-style: italic;
        }

        .csl-entry b {
            font-weight: bold;
        }

        .csl-entry sup {
            vertical-align: super;
            font-size: smaller;
        }

        .csl-entry sub {
            vertical-align: sub;
            font-size: smaller;
        }

        .csl-indent {
            padding-left: 0.5in;
        }

        .csl-entry {
            clear: left;
        }

        .csl-left-margin {
            clear: left;
            float: left;
            white-space: pre;
        }

        .csl-right-inline {
            padding-left: 20px;
        }

        span.anchor {
            text-decoration: underline;
            color: green;
        }

        figure figcaption {
            margin-top: 10px;
            font-size: .9em;
        }

        figure img {
            max-width: 100%
        }

        figure {
            width: calc(80% - 12px);
            border: 1px solid black;
            padding: 5px;
            text-align: center;
 
            cursor: pointer;
            margin: 10%;
            clear: both;
        }

        .aligned-right {
            float: right;
        }

        .aligned-left {
            float: left;
        }

        .aligned-center {
            float: none;
            display: block;
            margin-left: auto;
            margin-right: auto;
            align-content: center;
        }

        .image-width-100 {
            width: 70%;
        }

        .image-width-75 {
            width: 55%;
        }

        .image-width-50 {
            width: 40%;
        }

        .image-width-25 {
            width: 20%;
        }

        .figure-cat-figure::after {
            counter-increment: figure-cat-0;
            content: ' 'counter(figure-cat-0) ': ';
        }

        .figure-cat-photo::after {
            counter-increment: figure-cat-1;
            content: ' 'counter(figure-cat-1) ': ';
        }

        .figure-cat-table::after {
            counter-increment: figure-cat-2;
            content: ' 'counter(figure-cat-2) ': ';
        }

        .user-contents a,
        .user-contents a:hover {
            color: #84b4a7;
            text-decoration: underline;
        }

        table {
            clear: both
        }

        .table-25 {
            width: 25%;
        }

        .table-50 {
            width: 50%;
        }

        .table-75 {
            width: 75%;
        }

        .table-100 {
            width: 100%;
        }

        .table-center {
            margin-left: auto !important;
            margin-right: auto !important;
            clear: both;
        }

        .table-left {
            float: left;
        }

        .table-right {
            float: right;
        }

        .user-contents a,
        .user-contents a:hover {
            color: #84b4a7;
            text-decoration: underline;
        }

        .table-fixed {
            table-layout: fixed !important;
        }

        .table-auto {
            table-layout: auto !important;
        }


        .article .table-of-contents h1,
        .article .table-of-contents h2,
        .article .table-of-contents h3,
        .article .table-of-contents h4,
        .article .table-of-contents h5,
        .article .table-of-contents h6 {
            font-size: 1em;
            font-weight: normal;
            font-family: 'Lato', sans-serif;
            margin-bottom: unset;
        }

        .article .table-of-contents h2 {
            padding-left: 1em;
        }

        .article .table-of-contents h3 {
            padding-left: 2em;
        }

        .article .table-of-contents h4 {
            padding-left: 3em;
        }

        .article .table-of-contents h5 {
            padding-left: 4em;
        }

        .article .table-of-contents h6 {
            padding-left: 5em;
        }

        .article .table-of-contents h1.toc {
            font-style: italic;
        }

        .underline {
            text-decoration: underline;
        }

        ul,
        li {
            margin: 0;
        }

        .figure-cat-figure {
            counter-increment: figure-cat-0;
        }

        .figure-cat-photo {
            counter-increment: figure-cat-1;
        }

        .figure-cat-table {
            counter-increment: figure-cat-2;
        }

        .footnote-ref {
            text-decoration: none;
        }

        .footnote-ref sup {
            font-size: 0.8em;
            line-height: 0;
            position: static;
            vertical-align: super;
            top: 0;
        }

        .footnote-break {
            width: 40%;
            border-width: 0;
            background-color: black;
            height: 1px;
        }

        .footnote {
            color: dimgray;
        }

 

        .article table[data-split-from] {
            border-top: initial;
        }

        .article table[data-split-to] {
            border-bottom: initial;
        }

        [data-align-last-split-element='justify'] {
            text-align-last: initial;
        }





        



  .title{font-size: 25px;
    font-weight: bold;}
	.width-1{width:5% !important;; }
	.width-2{width:35% !important;; }
	.width-3{width:60% !important;; }
	.td_0{border:1px solid white!important; padding:0px !important; margin:0px !important;}
	td { color: black !important; }
	
	 

 
            /** Tables -------------------------------------- **/
 

 

 
 

        @media print {
            /* For link color to be unchanged if it is clicked or not */
            .article p a {
                color: #3463ef !important;
            }
 
        }
 
 .page-break {
  page-break-before: always;
}
        
	</style>
</head>

<body class="article">
    <script>
        ready.then(async function () {
            let flowText = document.querySelector(".article");
            let paged = new Paged.Previewer()

            paged.preview(flowText.content).then((flow) => {
                let editable = document.querySelectorAll(".pagedjs_page .pagedjs_area > div");
                for (let i = 0; i < editable.length; i++) {
                    editable[i].setAttribute("contenteditable", false);
                }
            });

            //To Resize the content
            let resizer = () => {
                let pages = document.querySelector(".pagedjs_pages");

                if (pages) {
                    let scale = ((window.innerWidth * .9) / pages.offsetWidth);
                    if (scale < 1) {
                        pages.style.transform =
                            `scale(${scale}) translate(${(window.innerWidth / 2) - ((pages.offsetWidth * scale / 2))}px, 0)`;
                    } else {
                        pages.style.transform = "none";
                    }
                }
            };
            resizer();

            window.addEventListener("resize", resizer, false);

            paged.on("rendering", () => {
                resizer();
            });
        });
    </script>
 

    
<div contenteditable="true">
	<?php echo $data; ?></div>
</body>

</html>