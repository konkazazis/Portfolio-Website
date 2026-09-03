import hljs from 'highlight.js';
import 'highlight.js/styles/github-dark-dimmed.css';

const highlightCodeBlocks = () => {
	document.querySelectorAll('pre.ql-syntax, pre code').forEach((block) => {
		if (!block.classList.contains('hljs')) {
			hljs.highlightElement(block);
		}
	});
};

document.addEventListener('DOMContentLoaded', highlightCodeBlocks);
