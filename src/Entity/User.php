<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $session;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siret;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diplome;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateNaissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NAF;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Effectif;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ConventionCollective;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $EmployeurPublic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CodeIDCCConvention;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Genre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $RepresentantLegal1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $RepresentantLegal2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NIR;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DepNaissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CommuneNaissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Nationalite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $RegimeSocial;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $TravailleurHandicape;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $SportifHautNiveau;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SituationAvantContrat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DernierDiplome;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DerniereClasse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DiplomePlusHaut;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $CFA;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DenominationCFAResponsable;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NumeroUAICFA;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DiplomeVise;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $IntitulePreciDiplomevise;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getSession(): ?string
    {
        return $this->session;
    }

    public function setSession(?string $session): self
    {
        $this->session = $session;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getDiplome(): ?string
    {
        return $this->diplome;
    }

    public function setDiplome(?string $diplome): self
    {
        $this->diplome = $diplome;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->DateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $DateNaissance): self
    {
        $this->DateNaissance = $DateNaissance;

        return $this;
    }

    public function getNAF(): ?string
    {
        return $this->NAF;
    }

    public function setNAF(?string $NAF): self
    {
        $this->NAF = $NAF;

        return $this;
    }

    public function getEffectif(): ?int
    {
        return $this->Effectif;
    }

    public function setEffectif(?int $Effectif): self
    {
        $this->Effectif = $Effectif;

        return $this;
    }

    public function getConventionCollective(): ?string
    {
        return $this->ConventionCollective;
    }

    public function setConventionCollective(?string $ConventionCollective): self
    {
        $this->ConventionCollective = $ConventionCollective;

        return $this;
    }

    public function getEmployeurPublic(): ?bool
    {
        return $this->EmployeurPublic;
    }

    public function setEmployeurPublic(?bool $EmployeurPublic): self
    {
        $this->EmployeurPublic = $EmployeurPublic;

        return $this;
    }

    public function getCodeIDCCConvention(): ?string
    {
        return $this->CodeIDCCConvention;
    }

    public function setCodeIDCCConvention(?string $CodeIDCCConvention): self
    {
        $this->CodeIDCCConvention = $CodeIDCCConvention;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->Genre;
    }

    public function setGenre(?string $Genre): self
    {
        $this->Genre = $Genre;

        return $this;
    }

    public function getRepresentantLegal1(): ?string
    {
        return $this->RepresentantLegal1;
    }

    public function setRepresentantLegal1(?string $RepresentantLegal1): self
    {
        $this->RepresentantLegal1 = $RepresentantLegal1;

        return $this;
    }

    public function getRepresentantLegal2(): ?string
    {
        return $this->RepresentantLegal2;
    }

    public function setRepresentantLegal2(?string $RepresentantLegal2): self
    {
        $this->RepresentantLegal2 = $RepresentantLegal2;

        return $this;
    }

    public function getNIR(): ?string
    {
        return $this->NIR;
    }

    public function setNIR(?string $NIR): self
    {
        $this->NIR = $NIR;

        return $this;
    }

    public function getDepNaissance(): ?string
    {
        return $this->DepNaissance;
    }

    public function setDepNaissance(?string $DepNaissance): self
    {
        $this->DepNaissance = $DepNaissance;

        return $this;
    }

    public function getCommuneNaissance(): ?string
    {
        return $this->CommuneNaissance;
    }

    public function setCommuneNaissance(?string $CommuneNaissance): self
    {
        $this->CommuneNaissance = $CommuneNaissance;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->Nationalite;
    }

    public function setNationalite(?string $Nationalite): self
    {
        $this->Nationalite = $Nationalite;

        return $this;
    }

    public function getRegimeSocial(): ?string
    {
        return $this->RegimeSocial;
    }

    public function setRegimeSocial(?string $RegimeSocial): self
    {
        $this->RegimeSocial = $RegimeSocial;

        return $this;
    }

    public function getTravailleurHandicape(): ?string
    {
        return $this->TravailleurHandicape;
    }

    public function setTravailleurHandicape(?string $TravailleurHandicape): self
    {
        $this->TravailleurHandicape = $TravailleurHandicape;

        return $this;
    }

    public function getSportifHautNiveau(): ?bool
    {
        return $this->SportifHautNiveau;
    }

    public function setSportifHautNiveau(?bool $SportifHautNiveau): self
    {
        $this->SportifHautNiveau = $SportifHautNiveau;

        return $this;
    }

    public function getSituationAvantContrat(): ?string
    {
        return $this->SituationAvantContrat;
    }

    public function setSituationAvantContrat(?string $SituationAvantContrat): self
    {
        $this->SituationAvantContrat = $SituationAvantContrat;

        return $this;
    }

    public function getDernierDiplome(): ?string
    {
        return $this->DernierDiplome;
    }

    public function setDernierDiplome(?string $DernierDiplome): self
    {
        $this->DernierDiplome = $DernierDiplome;

        return $this;
    }

    public function getDerniereClasse(): ?string
    {
        return $this->DerniereClasse;
    }

    public function setDerniereClasse(?string $DerniereClasse): self
    {
        $this->DerniereClasse = $DerniereClasse;

        return $this;
    }

    public function getDiplomePlusHaut(): ?string
    {
        return $this->DiplomePlusHaut;
    }

    public function setDiplomePlusHaut(?string $DiplomePlusHaut): self
    {
        $this->DiplomePlusHaut = $DiplomePlusHaut;

        return $this;
    }

    public function getCFA(): ?bool
    {
        return $this->CFA;
    }

    public function setCFA(?bool $CFA): self
    {
        $this->CFA = $CFA;

        return $this;
    }

    public function getDenominationCFAResponsable(): ?string
    {
        return $this->DenominationCFAResponsable;
    }

    public function setDenominationCFAResponsable(?string $DenominationCFAResponsable): self
    {
        $this->DenominationCFAResponsable = $DenominationCFAResponsable;

        return $this;
    }

    public function getNumeroUAICFA(): ?string
    {
        return $this->NumeroUAICFA;
    }

    public function setNumeroUAICFA(?string $NumeroUAICFA): self
    {
        $this->NumeroUAICFA = $NumeroUAICFA;

        return $this;
    }

    public function getDiplomeVise(): ?string
    {
        return $this->DiplomeVise;
    }

    public function setDiplomeVise(?string $DiplomeVise): self
    {
        $this->DiplomeVise = $DiplomeVise;

        return $this;
    }

    public function getIntitulePreciDiplomevise(): ?string
    {
        return $this->IntitulePreciDiplomevise;
    }

    public function setIntitulePreciDiplomevise(?string $IntitulePreciDiplomevise): self
    {
        $this->IntitulePreciDiplomevise = $IntitulePreciDiplomevise;

        return $this;
    }
}
