import hljs from 'highlight.js';
import 'highlight.js/styles/github-dark-dimmed.css';
import '../css/highlight.css';

const highlightCodeBlocks = () => {
	document.querySelectorAll('pre.ql-syntax, pre code').forEach((block) => {
		if (!block.classList.contains('hljs')) {
			hljs.highlightElement(block);
		}

		// Code blocks scroll horizontally, so keyboard users need to be able to focus them.
		block.setAttribute('tabindex', '0');
	});
};

document.addEventListener('DOMContentLoaded', highlightCodeBlocks);
