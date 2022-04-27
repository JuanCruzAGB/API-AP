/**
 * * Set the switch input password type event.
 * @export
 * @param {object} [params={}]
 */
export function addPasswordSwitchEvent (params = {}) {
    if ((params.btn || document.querySelector('.btn.switch-password'))) {
        (params.btn || document.querySelector('.btn.switch-password')).addEventListener('click', function (e) {
            e.preventDefault();
    
            for (const child of this.children) {
                if (child.nodeName == 'I') {
                    child.classList.toggle('fa-eye');
                    child.classList.toggle('fa-eye-slash');
                }
            }
    
            let input = document.querySelector(`input#${ this.dataset.for }`);
    
            input.type = input.type == 'password' ? 'text' : 'password';
        });
    }
}