<section class="section bg-accent-6 pt-50 pb-50 fade">
                <div class="container">
                    <div class="row gy-4">
                    <?php 
                        $programme_and_credit_structure_title = get_sub_field('programme_and_credit_structure_title');
                        if (!empty($programme_and_credit_structure_title)) : ?>
                            <div class="col-12">
                                <div class="section-heading">
                                <h2 class="h1"><?php echo wpautop($programme_and_credit_structure_title); ?></h2>
                                    
                                </div>
                            </div>
                    <?php endif; ?>
                        <div class="col-12">
                            <div class="row gy-4">
                                <div class="col-12 col-lg-7">
                                    <div class="row gy-4">
                                    <?php 
                                    $programme_and_credit_structure_image = get_sub_field('programme_and_credit_structure_image'); 
                                     if (!empty($programme_and_credit_structure_title)) : ?>
                                        <div class="col-12 col-md-8">
                                            <img src="<?php echo esc_url($programme_and_credit_structure_image['url']); ?>" class="w-100" title="<?php echo esc_attr($programme_and_credit_structure_image['title'] ?? 'Banner title'); ?>"
                                                alt="<?php echo esc_attr($programme_and_credit_structure_image['alt'] ?? 'Banner Image'); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <?php 
                                    $chart_label = get_sub_field('chart_label'); 
                                     if (!empty($chart_label)) : ?>
                                        <div class="col-12 col-md-4 align-self-end">
                                            <div class="chart-label-wrap">
                                            <?php echo wpautop($chart_label); ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-5">
                                    <div class="table-responsive">
                                    <?php 
                                    $field_object = get_sub_field_object('categories_&_required_credits');
                                    $label = $field_object['label'] ?? '';
                                    $parts = explode('&', $label);
                                    $first_part = trim($parts[0]);
                                    $second_part = trim($parts[1]);
                                      ?>
                                        <table class="table table-2 align-middle">
                                            <thead>
                                                <tr>
                                                    <th><?php echo wpautop($first_part); ?></th>
                                                    <th width="70%"><?php echo wpautop($second_part); ?></th>
                                                </tr>
                                            </thead>
                                            <?php 
                                        $categories_and_required_credits = get_sub_field('categories_&_required_credits'); 
                                       
                                        if (!empty($categories_and_required_credits) && is_array($categories_and_required_credits)) :?>
                                        
                                            <tbody>
                                            <?php foreach ($categories_and_required_credits as $index => $faq) : 
                                                $categories = $faq['categories'] ?? '';
                                                $required_credits = $faq['required_credits'] ?? ''; ?>
                                                <tr>
                                                    <td><?php echo wpautop($categories); ?></td>
                                                    <td class="count-number"><?php echo wpautop($required_credits); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        <?php endif; ?>

                                           
                                        </table>
                                    </div>
                                    <?php 
                                    $table_below_content = get_sub_field('table_below_content'); 
                                     if (!empty($table_below_content)) : ?>
                                    <p class="text-primary-dark fst-italic fs-6"><?php echo esc_attr($table_below_content); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
<script>
document.addEventListener('DOMContentLoaded', function () {
  let total = 0;
  const countCells = document.querySelectorAll('td.count-number p');

  countCells.forEach((cell, index) => {
    if (index === countCells.length - 1) return; // Skip the last one

    const number = parseInt(cell.textContent.trim(), 10);
    if (!isNaN(number)) {
      total += number;
    }
  });

  // Create and append <tfoot> with total
  const table = document.querySelector('table');
  if (table) {
    // Remove existing <tfoot> if any
    const existingTfoot = table.querySelector('tfoot');
    if (existingTfoot) {
      existingTfoot.remove();
    }

    const tfoot = document.createElement('tfoot');
    tfoot.innerHTML = `
      <tr>
        <th>Total</th>
        <th class="total-count">${total}</th>
      </tr>
    `;
    table.appendChild(tfoot);
  }
});
</script>