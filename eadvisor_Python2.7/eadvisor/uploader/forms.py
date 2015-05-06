from django import forms

TRACKS = (
         ('1', 'Multimedia'),
         ('2', 'Internet and Enterprise Computing'),
         ('3', 'Software Engineering'),
       ('4', 'Scientific Computing'),
       ('5', 'Customized'),
)

class DocumentForm(forms.Form):
    docfile = forms.FileField(
        label='Select your TDA (PDF only)',
    )

class TrackForm(forms.Form):
        track_form = forms.ChoiceField(choices=TRACKS) 