The BOX Model:
===============

All HTML elements are considered as boxes, the term box model is used when taking about "design and layout". The CSS box model is essentially a box that wraps around HTML elements, and it consists of: margins, padding, border and content.
* The box model allows us to add a border around elements, and to space between elements. 
+ Content: The content of the box,where text and images appear.
+ Padding: Clears an area around the content. The padding is transparent.
+ Border: A border that goes around the padding and content.
+ Margin: Clears an area outside the border. The margin is transparent.

### Example:
div {
	padding: 30px;
	border: 10px;
	margin: 25px
}

* In order to set width and height of an element correctly in all browsers,you need to know how the box model works.
+ Important: When you set the width nd height of properties of an element with CSS, you just set the width and height of the content area. To calculate the full size of an element, you must also add padding, border and margins.

div {
	width: 320px;
	padding: 10px;
	border: 5px;
	margin: 0;
}
Let's do the math:
width(320px)+20px(left and right padding)+10px(left and right border)+0px(left and right margin)=350px

* Total Element Width = content width + left padding + right padding + left border + right border + left margin + right margin
* Total Element Height = content height + top padding + bottom padding + top border + left border + top margin + bottom margin 
