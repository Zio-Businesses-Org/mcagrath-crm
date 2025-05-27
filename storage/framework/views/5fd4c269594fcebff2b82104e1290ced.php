<?php $__env->startComponent('mail::message'); ?>
# Dear <?php echo e($name); ?>,

We are delighted to welcome you to the McGrath Consulting network of professionals. We believe that your skills and expertise will be a valuable addition to our network, and we look forward to a successful collaboration.
To help you get started, here are a few important details:

### Onboarding Process:

- **Review the Agreement**: Click the “View Contract” button below to review the One Time Service Agreement.
- **Accept or Reject**: After reviewing, click “Accept” or “Reject”.
- **If Accepted**:
    - You will be directed to the next page to enter a few details about yourself.
    - Click “Sign”.
- **Complete**: Once Sign is clicked, it will ask for your digital signature to complete the onboarding process.

<?php if(!empty($url)): ?>
    <?php $__env->startComponent('mail::button', ['url' => $url, 'themeColor' => ((!empty($themeColor)) ? $themeColor : '#1f75cb')]); ?>
    <?php echo e($actionText); ?>

     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>

### Documents:

Please email the following documents to [vendors@mcresi.com](mailto:vendors@mcresi.com):

- **Contractor or Business license copy**
- **Certificate of Insurance**: The email should be sent by your insurance agent directly to [COI@mcresi.com](mailto:COI@mcresi.com) with us added as Certificate Holder – “McGrath Consulting, 6 Melissa Dr, Barnegat, NJ 08005” and to mention under Description of Operations – “McGrath Consulting is added as an additional insured.”
- **Workers Compensation**: (If exempted, the letter of exemption)
- **W9**

### Upcoming Projects:
We will be reaching out to you shortly with details on your first project with us. Please review the project scope and deadlines, and let us know if you have any questions or need additional information.

### Communication:
For any questions or support, please do not hesitate to contact us. We are here to assist you with any queries you may have.

Once again, welcome to the team! We are excited to work with you and look forward to achieving great things together.

Best regards,

McGrath Consulting  
6 Melissa Dr.  
Barnegat, NJ 08005  
Phone #: 609-488-4290  
Email: [vendors@mcresi.com](mailto:vendors@mcresi.com)  
Website: [https://www.mcresi.com](https://www.mcresi.com)


<?php echo $__env->renderComponent(); ?>





<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/mail/vendor_co.blade.php ENDPATH**/ ?>