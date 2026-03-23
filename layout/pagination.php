<nav aria-label="Page navigation" class="mt-4 text-center">
    <ul class="pagination justify-content-center pagination-dark p-2 rounded">
        <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
            <a class="page-link bg-dark text-white border-secondary" href="<?php if($page > 1){ echo "?page=".($page - 1); } else { echo "#"; } ?>">Previous</a>
        </li>
        <?php for($i = 1; $i <= $pages; $i++): ?>
        <li class="page-item <?php if($page == $i) { echo 'active'; } ?>">
            <a class="page-link <?php if($page == $i) { echo 'bg-secondary text-white'; } else { echo 'bg-dark text-white'; } ?> border-secondary" href="?page=<?= $i; ?>"> <?= $i; ?> </a>
        </li>
        <?php endfor; ?>
        <li class="page-item <?php if($page >= $pages){ echo 'disabled'; } ?>">
            <a class="page-link bg-dark text-white border-secondary" href="<?php if($page < $pages){ echo "?page=".($page + 1); } else { echo "#"; } ?>">Next</a>
        </li>
    </ul>
</nav>