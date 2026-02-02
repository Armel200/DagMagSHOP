<!DOCTYPE html>
<html>
<head>
    <title>Bienvenue chez DacMagSHOP</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: white; padding: 20px; border: 1px solid #d1c4e9; border-radius: 5px;">
        <h1 style="color: #3f51b5; text-align: center;">Bienvenue, {{ $user->name }} !</h1>
        <p style="color: #666;">Merci de vous être inscrit chez DacMagSHOP. Cliquez sur le lien ci-dessous pour confirmer votre email :</p>
        <a href="{{ url('/email/verify/' . $user->id) }}" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #3f51b5; color: white; text-decoration: none; border-radius: 5px;">Confirmer mon email</a>
        <p style="color: #666; margin-top: 20px;">Si vous n'avez pas créé de compte, ignorez cet email.</p>
    </div>
</body>
</html>