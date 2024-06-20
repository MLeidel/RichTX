<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<title>RichTX DEMO</title>
	<script type="text/javascript" src="../js/myJS-1.2.min.js"></script>
	<script src="richtx.js"></script>

	<style>
    #CE1 {
        padding: 5px;
        width: 95%;
        height: 400px;
        border: 1px solid navy;
        overflow: auto;
    }
    #TA1 {
        height: 400px; /*Note: must be same as #CE*/
        width: 95%;  /*Note: must be same as #CE*/
        background: #111;
        color: lightgreen;
        font: normal 10pt monospace;
    }
    input[type="button"] {
      border: thin solid gray;
      cursor: pointer;
      border-radius: 15px;
      /*width: 70px;*/
    }
  </style>

</head>
<body>
<h1 style="margin:auto;">RichTX DEMO</h1>

<div id="RTX1"></div><br><center>
<input type="button" onclick="Rtx1.switchView()" value="Switch">
<input type="button" onclick="RTXexec('bold')" value="Bold">
<input type="button" onclick="RTXexec('italic')" value="Italic">
<input type="button" onclick="RTXexec('underline')" value="Underline">
<input type="button" onclick="RTXexec('fontSize', askValue('Enter Font Size 1-7'))" value="Font Size">
<input type="button" onclick="RTXexec('fontName', askValue('Enter Font Name'))" value="Font Name">
<input type="button" onclick="RTXexec('foreColor', askValue('Enter Text Color'))" value="Text Color">
<input type="button" onclick="RTXexec('insertHorizontalRule')" value="Line">
<br><br>
<input type="button" onclick="RTXexec('hiliteColor', askValue('Enter color for highlighting'))" value="Highlight">
<input type="button" onclick="RTXexec('createLink', askValue('Enter URL for Link'))" value="Link">
<input type="button" onclick="insertImage()" value="Image">
<input type="button" onclick="RTXexec('insertUnorderedList')" value="List">
<input type="button" onclick="RTXexec('indent')" value="Indent">
<input type="button" onclick="RTXexec('outdent')" value="Outdent">
<input type="button" onclick="RTXexec('justifyCenter')" value="Center">
<input type="button" onclick="RTXexec('justifyLeft')" value="Left">
<input type="button" onclick="RTXexec('justifyRight')" value="Right">
<br><br>
<input type="button" onclick="JS.webget('inx.dat', 1);" value="Open">
<input type="button" onclick="saveDocument()" value="Save">
</center>

<script>
/* create and display the RichTX area */

const Rtx1 = new RichTX("RTX1", "CE1", "TA1");
Rtx1.displayAtTarget();

/* Hot Keys and helper functions */

function askValue(msg) {
  let val = prompt(msg);
  if (!val) return false;
  return val;
}

function insertImage() {
  /* to insert a graphic use the insertHTML command ...
     NOTE: the graphic must have an Internet URL */
  url = askValue("Enter URL for image");
  if (url) RTXexec("insertHTML", `<img src='${url}' width=""  height=""  />`);
}

function webresponse(n, text) {
  switch (n) {
    case 1:
      Rtx1.setText(text);
      break;
    case 2:
      // ... and so on
      break;
  }
}

function saveDocument() {
  text = Rtx1.getText();
  JS.websend("writehand.php", `txt=${text}`);
  alert("Document Saved");
}

  /* keyboard event listener for Saving Second RichTX object
     NOTE: the Rtx1.CEobj object is provided by RichTX */

Rtx1.CEobj.addEventListener('keydown', function(event) {
  if ((event.ctrlKey || event.metaKey) && event.key === 's') {
      event.preventDefault();
      saveDocument();
  }
});

JS.webget('inx.dat', 1);  // open the saved document on page load
</script>
</body>
</html>