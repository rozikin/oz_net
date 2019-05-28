   <!-- Footer -->
   <footer class="sticky-footer bg-white">
       <div class="container my-auto">
           <div class="copyright text-center my-auto">
               <span>Copyright &copy; PAC <?= date('Y'); ?> </span>
           </div>
       </div>
   </footer>
   <!-- End of Footer -->

   </div>
   <!-- End of Content Wrapper -->

   </div>
   <!-- End of Page Wrapper -->

   <!-- Scroll to Top Button-->
   <a class="scroll-to-top rounded" href="#page-top">
       <i class="fas fa-angle-up"></i>
   </a>

   <!-- Logout Modal-->
   <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">×</span>
                   </button>
               </div>
               <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
               <div class="modal-footer">
                   <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                   <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
               </div>
           </div>
       </div>
   </div>

   <!-- Bootstrap core JavaScript-->




   <script>
       $(document).ready(function() {
           $('#myTable').DataTable();
           responsive: true
       });
   </script>

   <script>
       $('.custom-file-input').on('change', function() {

           let fileName = $(this).val().split('\\').pop();
           $(this).next('.custom-file-label').addClass("selected").html(fileName);

       });
   </script>

   <script>
       $('.form-check-input').on('click', function() {

           const menuId = $(this).data('menu');
           const roleId = $(this).data('role');

           $.ajax({
               url: "<?= base_url('admin/changeaccess'); ?>",
               type: 'post',
               data: {
                   menuId: menuId,
                   roleId: roleId
               },
               success: function() {
                   document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
               }

           });

       });
   </script>


   <script>
       $(document).ready(function() {

           // Gets the video src from the data-src on each button

           var $videoSrc;
           $('.video-btn').click(function() {
               $videoSrc = $(this).data("src");
           });
           console.log($videoSrc);



           // when the modal is opened autoplay it  
           $('#myModal').on('shown.bs.modal', function(e) {

               // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
               $("#videox").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
           })



           // stop playing the youtube video when I close the modal
           $('#myModal').on('hide.bs.modal', function(e) {
               // a poor man's stop video
               $("#videox").attr('src', '');


           })
           // document ready  
       });
   </script>












   </body>

   </html>