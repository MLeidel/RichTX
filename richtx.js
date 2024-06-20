/* richtx.js
   Rich Text Editing widget for HTML5 and JS
    requires myJS.js
    compile with:
      https://closure-compiler.appspot.com/
        "whitespace only"

*/
  class RichTX {
    constructor(target, ce, ta) {
      this.target = target;
      this.ce = ce;
      this.ta = ta;
    }

    // method to display the text areas
    displayAtTarget() {
      var TG = document.getElementById(this.target);
      TG.innerHTML = `
    <textarea id="${this.ta}" wrap="on" style="display:none;" spellcheck="false"></textarea>
    <div id="${this.ce}" contenteditable="true" spellcheck="false"></div>
    `;
      /*  These two objects are available to the developer for
          access to the contentEditable and textarea widgets. */
      this.CEobj = JS.doq(`#${this.ce}`);  // the contentEditable Object
      this.TAobj = JS.doq(`#${this.ta}`);  // the textarea Object
    }

    // switch view HTML to text
    switchView() {
    	/* toggles between textarea
    	  and contentEditable
    	  copying text and toggling display */
    	if (JS.gss(`#${this.ta}`, "display") == 'none') {
    		let txt = this.CEobj.innerHTML;
    		txt = this.fmthtml(txt);
    		this.CEobj.innerHTML = txt;
      	JS.val(`#${this.ta}`, this.CEobj.innerHTML); // HTML ==> TEXT
      	JS.tod(`#${this.ta}`, "block");
      	JS.tod(`#${this.ce}`, "block");
      	JS.doq(`#${this.ta}`).focus();
    	} else {
    		this.CEobj.innerHTML = JS.val(`#${this.ta}`); // TEXT ==> HTML
    		JS.tod(`#${this.ce}`, "block");
    		JS.tod(`#${this.ta}`, "block");
    		this.CEobj.focus();
    	}
    }

    fmthtml(t) {
      /* formats the HTML when switching between text and CE
         used in switchView method */
    	t = t.replace(/<div/g, "\n<div");
    	t = t.replace(/<br>/g, "<br>\n");
    	t = t.replace(/<\/div>/g, "\n</div>\n");
    	t = t.replace(/<\/blockquote>/g, "</blockquote>\n");
    	t = t.replace(/<blockquote/g, "\n<blockquote");
    	t = t.replace(/<\/span>/g, "</span>\n");
    	t = t.replace(/<span/g, "\n<span");
    	t = t.replace(/<ul/g, "\n<ul");
    	t = t.replace(/<ol/g, "\n<ol");
    	t = t.replace(/<\/ul>/g, "\n</ul>\n");
    	t = t.replace(/<\/ol>/g, "\n</ol>\n");
    	t = t.replace(/<li/g, "\n	<li");
    	t = t.replace(/\n\n/g, "\n"); // clean up extra blank lines
    	return t;
    }

    /*  OBJ.setText(text) loads the contextEditable object  */
    setText(t) {
      /* set new content */
      this.CEobj.innerHTML = t;
    }

    /*  OBJ.getText() gets, encodes, and returns content of the contextEditable object */
    getText() {
      /* return current content */
    	let txt = this.CEobj.innerHTML;
    	txt = encodeURIComponent(txt);
    	return txt;
    }

  } // end of class

  /*  RTXexec provides a wrapper around the execCommand function
      Formatting commands are applied to what ever contentEditable
      block has focus.
  */
  function RTXexec(com, data = null) {
      let r = document.execCommand(com, false, data);
      if (r === false) {
        alert("Canceled, or Command invalid or not supported!");
      }
  }

// END OF RICHTX LIB
