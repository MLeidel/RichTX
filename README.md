# RichTX
### Enhanced ContentEditable

Although __document.execCommand__ was never fully developed, it is still
implemented in most web browsers. When used with __contentEditable__ and __textarea__
you can embed a useful but limited document editor into web pages.

RichTX is a Javascript library, __richtx.js__, that can be used, like say,
a _fancy_ textarea that you might use when more advanced text formatting 
is wanted.

The following compares coding an HTML textarea and a RichTX:

```html
<!-- textarea -->

<textarea id="TA" wrap="on" spellcheck="false"></textarea>

<!-- RichTX -->

<div id="RTX1"></div>


```

'wrap' and 'spellcheck' are set to 'on' and 'false' by default for
the RichTX object.

To create, a RichTX object it must be instantiated and displayed.

Example (Javascript):

```javascript
  /* Instantiate RichTX object
      Each RichTX object consists of a DIV which will contain
      an overlapping contextEditable area and a textarea. */
      
  const Rtx1 = new RichTX("RTX1", "CE1", "TA1");
    
    /*  Values to initialize a RichTX object:
        1. ID of the DIV used for the RichTX
        2. ID of the RichTX contentEditable 
        3. ID of the RichTX textarea  */

  Rtx1.displayAtTarget();
  
  /*  This method is required to activate aRichTX object at
      the DIV that was set up. */

```
By default BOLD (ctrl-B), ITALIC (ctrl-I), and UNDERLINE (ctrl-U) 
are available with no further code needed.

RichTX provides several methods, variables, and a function for
developers to build-in many more text formatting features.

---

## Methods Provided

### displayAtTarget

RichTX_obj.displayAtTarget();

Example usage:
```javascript
Rtx1.displayAtTarget();

```
As shown above, this method displays the instantiated RichTX object on in the page.

---

### switchView

RichTX_obj.switchView();

Example usage:
```html
<input type="button" onclick="Rtx1.switchView();" value="Switch" />

```
Toggles the contentEditable view and the HTML view.

---
### setText(_t_)

RichTX_obj.setText(text);

Example usage:

```javascript
// Perhaps you obtain text from a server file or database

Rtx1.setText(text);

```
---

### getText()

RichTX_obj.getText();

Example usage:

```javascript
text = Rtx1.getText(); 

// text now has encoded URI components
// and is ready to be written to your file or database


```
---

## Function Provided

### RTXexec(command [,value])

RTXexec is a wrapper for a _document.execCommand()_ function.
Required values are a _command_, and for some commands a value is needed.
Commands are always strings. Values can be a string or a number.

Example:

```Javascript 

 RTXexec("Indent");  // starts indented text
 
 RTXexec("fontName", "Arial");  // start Arial font
 
 RTXexec("fontSize", 3);  // change font size (1-7)

```
Note that the RichRTX instance object is not required because the _document.execCommand_ scopes
the entire document. __The command is applied at the current cursor position in a contentEditable area__
which is a part of each RichRTX instance.


---
## RichTX commands


### backColor
Changes the document background color. In styleWithCss mode, it affects the background color of the containing block instead. This requires a <color> value string to be passed in as a value argument.

### bold
Toggles bold on/off for the selection or at the insertion point.

### contentReadOnly
Makes the content document either read-only or editable. This requires a boolean true/false as the value argument.

### createLink
Creates an hyperlink from the selection, but only if there is a selection. Requires a URI string as a value argument for the hyperlink's href. The URI must contain at least a single character, which may be whitespace.

### decreaseFontSize
Adds a `<small>` tag around the selection or at the insertion point.

### fontName
Changes the font name for the selection or at the insertion point. This requires a font name string (like "Arial") as a value argument.

### fontSize
Changes the font size for the selection or at the insertion point. This requires an integer from 1 - 7 as a value argument.

### foreColor
Changes a font color for the selection or at the insertion point. This requires a hexadecimal color value string as a value argument.

### formatBlock
Adds an HTML block-level element around the line containing the current selection, 
replacing the block element containing the line if one exists 
Requires a tag-name string as a value argument. 
Virtually all block-level elements can be used. 

### heading
Adds a heading element around a selection or insertion point line. Requires the tag-name string as a value argument (i.e., "H1", "H6"). (Not supported by Safari.)

### hiliteColor
Changes the background color for the selection or at the insertion point. Requires a color value string as a value argument. useCSS must be true for this to function.

### increaseFontSize
Adds a `<big>` tag around the selection or at the insertion point.

### indent
Indents the line containing the selection or insertion point. 
In Firefox, if the selection spans multiple lines at different levels of indentation, 
only the least indented lines in the selection will be indented.

### insertBrOnReturn
Controls whether the Enter key inserts a `<br>` element, 
or splits the current block element into two.

### insertHorizontalRule
Inserts a `<hr>` element at the insertion point, or replaces the selection with it.

### insertHTML
Inserts an HTML string at the insertion point (deletes selection). Requires a valid HTML string as a value argument.

### insertImage
Inserts an image at the insertion point (deletes selection). Requires a URL string for the image's src as a value argument. The requirements for this string are the same as createLink.

### insertOrderedList
Creates a numbered ordered list for the selection or at the insertion point.

### insertUnorderedList
Creates a bulleted unordered list for the selection or at the insertion point.

### insertParagraph
Inserts a paragraph around the selection or the current line.

### insertText
Inserts the given plain text at the insertion point (deletes selection).

### italic
Toggles italics on/off for the selection or at the insertion point.

### justifyCenter
Centers the selection or insertion point.

### justifyFull
Justifies the selection or insertion point.

### justifyLeft
Justifies the selection or insertion point to the left.

### justifyRight
Right-justifies the selection or the insertion point.

### outdent
Outdents the line containing the selection or insertion point.

### redo
Redoes the previous undo command.

### removeFormat
Removes all formatting from the current selection.

### selectAll
Selects all of the content of the editable region.

### strikeThrough
Toggles strikethrough on/off for the selection or at the insertion point.

### subscript
Toggles subscript on/off for the selection or at the insertion point.

### superscript
Toggles superscript on/off for the selection or at the insertion point.

### underline
Toggles underline on/off for the selection or at the insertion point.

### undo
Undoes the last executed command.

### unlink
Removes the anchor element from a selected hyperlink.

---

## Concerning CSS

CSS can be applied to adjust height, width, colors, etc.
Apply CSS to both the contentEditable div and the textarea.
Note the height and width must be the same for both.

Example:

```html
<div id="RTX1"></div><br>
<script>
const Rtx1 = new RichTX("RTX1", "CE1", "TA1");
Rtx1.displayAtTarget();

```

```css
    #CE1 {
    	padding: 5px;
    	width: 95%;
    	height: 250px;
    	border: 1px solid navy;
    	overflow: auto;
    }
    #TA1 {
    	height: 250px; /*Note: must be same as #CE*/
    	width: 95%;  /*Note: must be same as #CE*/
    	background: #111;
    	color: lightgreen;
    	font: normal 10pt monospace;
    }

```

## End Of Document






