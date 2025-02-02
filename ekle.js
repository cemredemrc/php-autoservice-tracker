// Modal Açma ve Kapatma İşlemleri
document.getElementById('addCustomerBtn').addEventListener('click', function() {
    document.getElementById('modal').style.display = 'block';
  });
  
  document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('modal').style.display = 'none';
  });
  
  window.addEventListener('click', function(event) {
    if (event.target === document.getElementById('modal')) {
      document.getElementById('modal').style.display = 'none';
    }
  });
  
  // Form Gönderme İşlemi
  document.getElementById('customerForm').addEventListener('submit', function(event) {
    event.preventDefault();
  
    const name = document.getElementById('customerName').value;
    const phone = document.getElementById('customerPhone').value;
    const address = document.getElementById('customerAddress').value;
  
    alert(`Müşteri Kaydedildi!\n\nİsim: ${name}\nTelefon: ${phone}\nAdres: ${address}`);
    
    // Formu temizle ve modal'ı kapat
    document.getElementById('customerForm').reset();
    document.getElementById('modal').style.display = 'none';
  });
  