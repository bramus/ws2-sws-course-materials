/**
 * Dependency of CSS editing plugins like CSS Snippets or CSS Controls
 * @author Lea Verou
 * MIT License
 *
 * Adjusted by Bramus! (@bramus) to work with Reveal.js and with contentEditable
 */
 
(function(){

var dummy = document.createElement('div');
 
var self = window.CSSEdit = {
	isCSSValid: function(code) {
		var declarationCount = code.split(':').length - 1;
			
		dummy.removeAttribute('style');
		dummy.setAttribute('style', code);
		
		return declarationCount > 0 && dummy.style.length >= declarationCount;
	},
	
	setupSubjects: function(subjects) {
		for (var i=0; i<subjects.length; i++) {
			var subject = subjects[i];
			subject.setAttribute('data-originalstyle', subject.getAttribute('style'));
			subject.setAttribute('data-originalcssText', subject.style.cssText);
		}
	},
	
	getSubjects: function(element) {
		var selector = element.getAttribute('data-subject');
	
		if (!selector) return [];
		if (selector == "slide") return [Reveal.getCurrentSlide()];		
		return self.util.toArray(document.querySelectorAll(selector)) || [];

	},
	
	updateStyle: function(subjects, code, originalAttribute) {
		code = PrefixFree.prefixCSS(code.trim());
		
		if(code && self.isCSSValid(code)) {
			dummy.setAttribute('style', code);
			
			var appliedCode = dummy.style.cssText;
			// if(appliedCode.match(/\b[a-z-]+(?=:)/gi) === null) console.log('"' + appliedCode + '"');
			var properties = appliedCode.match(/\b[a-z-]+(?=:)/gi), propRegex = [];
			
			for(var i=0; i<properties.length; i++) {
				properties[i] = self.util.camelCase(properties[i]);
			}
			
			for (var i=0; i<subjects.length; i++) {
				
				// Reveal.js Slides Integration
				if (subjects[i] == "slide") {
					subjects[i] = Reveal.getCurrentSlide();
				}
				
				var element = subjects[i],
					prevStyle = subjects[i].getAttribute('style'),
					style = prevStyle;
				
				if(prevStyle && prevStyle !== 'null') {	
					for(var j=0; j<properties.length; j++) {
						element.style[properties[i]] = null;
					}
					
					element.setAttribute('style', element.getAttribute(originalAttribute) + '; ' + code);
				}
				else {
					element.setAttribute('style', code);
				}
			}
			
			return true;
		}
		else {
			return false;
		}
	},
	
	util: {
		camelCase: function(str) {
			return str.replace(/-(.)/g, function($0, $1) { return $1.toUpperCase() })
		},
		
		toArray: function(collection) {
			return Array.prototype.slice.apply(collection);
		}
		
	}
 };
  
 })()