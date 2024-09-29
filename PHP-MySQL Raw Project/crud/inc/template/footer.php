	<script type="text/javascript" src="inc\assets\js\bootstrap.min.js"></script>
	<script type="text/javascript" src="inc\assets\js\bootstrap.esm.min.js"></script>
	<script type="text/javascript" src="\assets\js\bootstrap.bundle.min.js"></script>
	<script>
		const delItems = document.querySelectorAll(".delete");
		delItems.forEach((item)=>{
			item.addEventListener("click",(e)=>{
				if (!confirm("Are You Delete")) {
					e.preventDefault();
				}
			})
			
		})
	</script>
</body>

</html>