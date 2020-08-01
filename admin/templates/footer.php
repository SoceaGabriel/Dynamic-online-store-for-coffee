<!--Footer section-->
<footer class="footer-part">
  &copy; 2019-2020 Coffee corner - Dashboard
</footer>
</div>
<!--Includem fisierul cu functiile js-->
<script src="js/function.js"></script>

<!--Ajax-->
<!--Folosim AJAX pentru a face collapse la sectiunile cu tabele si pentru a face show disable la acele sectiuni-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<?php
  //inchidem conexiunea
  oci_close($c);
?>
</body>
</html>
