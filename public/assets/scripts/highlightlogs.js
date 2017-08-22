
$(function() {
	$(":checkbox").on("change", function() {
   		$(this).parent().parent().parent().prev().toggleClass("checked", this.checked).css('fontWeight', 'bold');
	});
});