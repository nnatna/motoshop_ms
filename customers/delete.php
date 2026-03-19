<?php if(isset($_GET['msg'])): ?>
    <?php if($_GET['msg'] == 'deleted'): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> លុបទិន្នន័យអតិថិជនបានជោគជ័យ!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif($_GET['msg'] == 'error_has_sales'): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill"></i> មិនអាចលុបបានទេ! អតិថិជននេះមានប្រវត្តិទិញម៉ូតូក្នុងហាងរួចហើយ។
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
<?php endif; ?>