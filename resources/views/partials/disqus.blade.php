<div id="disqus_thread"></div>
<script>

	/**
	*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
	*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

	var disqus_config = function () {
	@if (isset($post))		
		this.page.url = "/b/{{ $post->slug }}";  // Replace PAGE_URL with your page's canonical URL variable
		this.page.identifier = 'blog-{{ $post->slug }}'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable 
	@endif

	};

	(function() { // DON'T EDIT BELOW THIS LINE
		var d = document, s = d.createElement('script');
		s.src = '//ragareport.disqus.com/embed.js';
		s.setAttribute('data-timestamp', +new Date());
		(d.head || d.body).appendChild(s);
	})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<a href="http://disqus.com" class="dsq-brlink">
	comments powered by <span class="logo-disqus">Disqus</span>
</a>
