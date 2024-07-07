import './bootstrap';

function deleteUser(id, name) {
    let del = confirm('¿realmente desea borrar el usuario ' + name + '?');
    if (del) {
        location.href = '/users/' + id + '/delete';
    }
}
