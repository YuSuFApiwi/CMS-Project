        </div>
        <!-- container-fluid -->
        
        </div>
        <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <?php echo  date('Y'); ?> by <code></></code> Youssef</span>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Prêt à partir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                Sélectionnez « Déconnexion » ci-dessous si vous êtes prêt à mettre fin à votre session en cours.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                    <a class="btn btn-info" href="logout.php">Déconnexion</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="js/vendor/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/admin.min.js"></script>

    <!-- Page level plugins -->
    <script src="js/vendor/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-bar-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <!-- Page level plugins -->
    <script src="js/vendor/jquery.dataTables.min.js"></script>
    <script src="js/vendor/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <?php 
        if (isset($after_js)) {
            echo $after_js;
        }        
    ?>

    <script>
        $(function(){
            "use strict";
            $('#content_page').summernote({
                height: 300,
            });


            
        });
        $('#confirm-delete').on('show.bs.modal', function(e) {
	        $(this).find('.btn-confirm').attr('href', $(e.relatedTarget).data('href'));
	    });

        $("#photo").change(function() {
            var input = this;
            var $this = $(this);
            console.log('photo upload');
            console.log(input);
            var $parent = $('.parent-img');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $parent.find('img').attr("src", "" + e.target.result + "");
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>

</body>
</html>