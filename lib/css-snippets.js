/**
 * Script to add prefixes to standard CSS3 in textareas or style attributes
 * Requires css-edit.js
 * @author Lea Verou
 * MIT License
 *
 * Adjusted by Bramus! (@bramus) to work with Reveal.js and with contentEditable
 */

(function(head) {

var self = window.CSSSnippet = function(element) {
	var me = this;
	
	// Get the subjects (referenced elements to apply the style to)
	me.subjects = CSSEdit.getSubjects(element);
	CSSEdit.setupSubjects(me.subjects);

	// Test if its text or code field first
	if(/^(input|textarea|code)$/i.test(element.nodeName)) {
		
		this.textField = element;
		
		// Turn spellchecking off
		this.textField.spellcheck = false;
		
		this.textField.addEventListener('input', function() {
			me.update();
		}, false);
		
		this.textField.addEventListener('keyup', function() {
			me.update();
		}, false);
		
		// update subjects
		// needed for when referring to current slide: must be updated first because it may refer to the wrong slide (viz. the slide that you started the presentation with)
		this.textField.addEventListener('focus', function() {
			me.subjects = CSSEdit.getSubjects(element);
			CSSEdit.setupSubjects(me.subjects);	
		}, false)
		
		// Update style
		me.update();
	
	} else {
		
		// Update style, only once
		this.update();
		
	}
}

self.prototype = {
	update: function() {
		var supportedStyle = PrefixFree.prefixCSS(this.getCSS());
		var valid = CSSEdit.updateStyle(this.subjects, this.getCSS(), 'data-originalstyle');
	
		if(this.textField && this.textField.classList) {
			this.textField.classList[valid? 'remove' : 'add']('error');
		}
	},
	
	getCSS: function() {
		return this.textField ? this.stripHTML(this.textField.value || this.textField.innerHTML) : this.subjects[0].getAttribute('style');
	},
	
	stripHTML : function(html) {
		var tmp = document.createElement('div');
		tmp.innerHTML = html;
		return tmp.textContent||tmp.innerText;
	}
};

})(document.head);